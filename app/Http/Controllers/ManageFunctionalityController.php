<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;

use App\Models\M300Kinosei;

class ManageFunctionalityController extends Controller
{
    // Page_ID
    const PG_ID = 'ManageFunctionalityController';

    /**
	 * Show Main & Search screen
	 * @param Request $req 
	 * @return type
	 */
    public function index(Request $req)
    {
    	// validate

    	// search
    	$function_list = M300Kinosei::select('*');
    	if (isset($req->item_nm)) {
    		$function_list = $function_list->where('item_nm', 'like', '%' . $req->item_nm . '%');
    	}
    	if (isset($req->todokede_no)) {
    		$function_list = $function_list->where('todokede_no', 'like', '%' . $req->todokede_no . '%');
    	}
    	if (isset($req->todokede_nm)) {
    		$function_list = $function_list->where('todokede_nm', 'like', '%' . $req->todokede_nm . '%');
    	}
    	if (!isset($req->included_deleted)) {
    		$function_list = $function_list->where('del_flg', '=', config('constant.flg.no'));
    	}
    	$function_list = $function_list->orderByRaw('kinosei_cd DESC')->paginate();

    	session()->flashInput($req->input());
    	return view(
            'manage.functionality.index',
            compact('function_list')
        );
    }

    /**
     * Do create, update, delete items
     * @param Request $req 
     * @return type
     */
    public function store(Request $req)
    {
        if (isset($req->create_mode)) {
            return self::do_insert($req);
        }
        if (isset($req->edit_mode)) {
            return self::do_update($req);
        }
    }

    /**
     * Show create screen
     * @param Request $req 
     * @return type
     */
    public function create(Request $req)
    {
        return view('manage.functionality.create_or_edit', [
            'mode' => 'create',
        ]);
    }

    /**
     * Show edit page
     * {kinosei_cd}/edit
     * @param string $kinosei_cd 
     * @return type
     */
    public function edit(Request $req, $kinosei_cd)
    {
        $function = M300Kinosei::find($kinosei_cd);
        return view('manage.functionality.create_or_edit', [
            'mode' => 'edit',
            'function' => $function,
        ]);
    }

    /**
     * Do insert item into the Database
     * @param Request $req 
     * @return type
     */
    public function do_insert(Request $req)
    {
        // validation
        $validator = \Validator::make($req->all(), [
            // 'kinosei_cd' => 'required|unique:m300_kinosei|max:10',
            'todokede_no' => 'required|max:255|unique:m300_kinosei',
            'pict' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'todokede_nm' => 'max:255',
            'item_nm' => 'max:255',
            'shokuhin_kb' => 'max:255',
            'hyoji_kinosei' => 'max:2000',
            'kanyo_seibun_nm' => 'max:255',
            'taisho' => 'max:255',
            'hyoka' => 'max:255',
            'info' => 'max:2000',
            'hyoka_hoho' => 'max:255',
            'henko_rireki' => 'max:2000',
            'tekkai_jiyu' => 'max:255',
            'shohi_info' => 'max:255',
            'meyasu' => 'max:255',
            'kanyo_seibun' => 'max:255',
            'genzairyo_nm' => 'max:2000',
            'hp' => 'max:255',
            'meisho' => 'max:255',
            'hanbai_yotei_date' => 'max:255',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->witherrors($validator);
        }

        DB::beginTransaction();
        try {
            // fill data from request
            $function = new M300Kinosei();
            $request_data = array_merge($function->default_values, $req->all());
            $function->fill($request_data);
            $function->after_fill_insert($req, self::PG_ID);

            $function->save(); // to get the new kinosei_id

            //公開フラグ up_contents
            $function->up_contents = isset($req->up_contents) ? config('constant.flg.yes') : config('constant.flg.no');

            // kinosei_categories
            $function->kinosei_categories()->sync(array_fill_keys($request_data['kinosei_categories'], [
                'del_flg' => config('constant.flg.no'),
                'crt_usr_id' => Auth::user()->id,
                'crt_pg_id' => self::PG_ID,
                'upd_usr_id' => Auth::user()->id,
                'upd_pg_id' => self::PG_ID,
            ]));

            // pict
            if ($req->is_updated_pict) {
                $this->upload_and_save_file($req, $function, 'pict');
            }

            // kinosei_suppliers
            $request_data['kinosei_suppliers'] = array_map(function($url_sup, $genzairyo_sup){
                return [
                    'url' => $url_sup,
                    'genryo_mei' => $genzairyo_sup,
                    'del_flg' => config('constant.flg.no'),
                    'crt_pg_id' => self::PG_ID,
                    'upd_pg_id' => self::PG_ID,
                ];}, $request_data['url_sup'], $request_data['genzairyo_sup']);
            $function->kinosei_suppliers()->delete();
            $function->kinosei_suppliers()->createMany($request_data['kinosei_suppliers']);

            $function->save();

            DB::commit();
            return redirect("/manage/functionality/{$function->kinosei_cd}/edit")->withInput()->with('success_message', sprintf(config('message.action_success'), '新規登録'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
        }
        return back()->withInput()->with([
            'fail_message' => sprintf(config('message.action_fail'), '新規登録'),
            'keep_input' => true,
        ]);
    }

    /**
     * Do update item into the Database
     * @param Request $req 
     * @return type
     */
    public function do_update(Request $req)
    {
        // validation
        $validator = \Validator::make($req->all(), [
            'todokede_no' => 'required|max:255|unique:m300_kinosei,todokede_no,'.$req->kinosei_cd.',kinosei_cd',
        	'pict' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'todokede_nm' => 'max:255',
            'item_nm' => 'max:255',
            'shokuhin_kb' => 'max:255',
            'hyoji_kinosei' => 'max:2000',
            'kanyo_seibun_nm' => 'max:255',
            'taisho' => 'max:255',
            'hyoka' => 'max:255',
            'info' => 'max:2000',
            'hyoka_hoho' => 'max:255',
            'henko_rireki' => 'max:2000',
            'tekkai_jiyu' => 'max:255',
            'shohi_info' => 'max:255',
            'meyasu' => 'max:255',
            'kanyo_seibun' => 'max:255',
            'genzairyo_nm' => 'max:2000',
            'hp' => 'max:255',
            'meisho' => 'max:255',
            'hanbai_yotei_date' => 'max:255',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->witherrors($validator)->with(['keep_input' => true]);
        }

        $function = M300Kinosei::find($req->kinosei_cd);
        if (isset($function)) {

            DB::beginTransaction();
            try {
                $request_data = array_merge($function->default_values, $req->all());
                $function->fill($request_data);
                $function->after_fill_update($req, self::PG_ID);

                //公開フラグ up_contents
                $function->up_contents = isset($req->up_contents) ? config('constant.flg.yes') : config('constant.flg.no');

                // kinosei_categories
                $function->kinosei_categories()->sync(array_fill_keys($request_data['kinosei_categories'], [
                    'del_flg' => config('constant.flg.no'),
                    'crt_usr_id' => Auth::user()->id,
                    'crt_pg_id' => self::PG_ID,
                    'upd_usr_id' => Auth::user()->id,
                    'upd_pg_id' => self::PG_ID,
                ]));

                // pict
                if ($req->is_updated_pict) {
                    $this->upload_and_save_file($req, $function, 'pict');
                }

                // kinosei_suppliers
                $request_data['kinosei_suppliers'] = array_map(function($url_sup, $genzairyo_sup){
                    return [
                        'url' => $url_sup,
                        'genryo_mei' => $genzairyo_sup,
                        'del_flg' => config('constant.flg.no'),
                        'crt_pg_id' => self::PG_ID,
                        'upd_pg_id' => self::PG_ID,
                    ];}, $request_data['url_sup'], $request_data['genzairyo_sup']);
                $function->kinosei_suppliers()->delete();
                $function->kinosei_suppliers()->createMany($request_data['kinosei_suppliers']);

                $function->save();

                DB::commit();
                return back()->withInput()->with('success_message', sprintf(config('message.action_success'), '更新'));
            } catch (\Exception $e) {
                DB::rollback();
                Log::error($e->getMessage());
            }
        }
        return back()->withInput()->with([
            'fail_message' => sprintf(config('message.action_fail'), '更新'),
            'keep_input' => true,
        ]);
    }
}
