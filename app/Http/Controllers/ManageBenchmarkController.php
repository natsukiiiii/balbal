<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;

use App\Models\M500Benchmark;

class ManageBenchmarkController extends Controller
{
    // Page_ID
    const PG_ID = 'ManageBenchmarkController';

    /**
	 * Show Main & Search screen
	 * @param Request $req 
	 * @return type
	 */
    public function index(Request $req)
    {
    	// validate

    	// search
    	$benchmark_list = M500Benchmark::select('*');
    	if (isset($req->hanbai_nm)) {
            $benchmark_list = $benchmark_list->where('hanbai_nm', 'like', '%' . $req->hanbai_nm . '%');
        }
        if (isset($req->item_nm)) {
    		$benchmark_list = $benchmark_list->where('item_nm', 'like', '%' . $req->item_nm . '%');
    	}
    	if (!isset($req->included_deleted)) {
    		$benchmark_list = $benchmark_list->where('del_flg', '=', config('constant.flg.no'));
    	}
    	$benchmark_list = $benchmark_list->orderByRaw('bench_cd + 0')->paginate();

    	session()->flashInput($req->input());
    	return view(
            'manage.benchmark.index',
            compact('benchmark_list')
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
        return view('manage.benchmark.create_or_edit', [
            'mode' => 'create',
        ]);
    }

    /**
     * Show edit page
     * {bench_cd}/edit
     * @param string $kinosei_cd 
     * @return type
     */
    public function edit(Request $req, $bench_cd)
    {
        $benchmark = M500Benchmark::find($bench_cd);
        return view('manage.benchmark.create_or_edit', [
            'mode' => 'edit',
            'benchmark' => $benchmark,
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
            'top_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meyasu' => 'digits_between:0,255',
            'kn' => 'digits_between:0,255',
            'sale_kn' => 'digits_between:0,255',
            'day_kn' => 'digits_between:0,255',
            'hanbai_nm' => 'max:255',
            'item_nm' => 'max:255',
            'meyasu' => 'max:255',
            'kn' => 'max:255',
            'sale_kn' => 'max:255',
            'day_kn' => 'max:255',
            'shuseibun' => 'max:255',
            'genzairyo_nm' => 'max:2000',
            'yukoseibun' => 'max:1000',
            'juryo' => 'max:255',
            'naiyoryo' => 'max:255',
            'site' => 'max:2000',
            'tokucho' => 'max:2000',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->witherrors($validator);
        }

        DB::beginTransaction();
        try {
            // fill data from request
            $benchmark = new M500Benchmark();
            $request_data = array_merge($benchmark->default_values, $req->all());
            $benchmark->fill($request_data);
            $benchmark->after_fill_insert($req, self::PG_ID);

            $benchmark->save(); // to get the new bench_cd

            // mokuteki_categories1
            $benchmark->mokuteki_categories1()->sync(array_fill_keys($request_data['mokuteki_categories1'], [
                'del_flg' => config('constant.flg.no'),
                'crt_usr_id' => Auth::user()->id,
                'crt_pg_id' => self::PG_ID,
                'upd_usr_id' => Auth::user()->id,
                'upd_pg_id' => self::PG_ID,
            ]));

            // top_pic
            if ($req->is_updated_pict) {
                $this->upload_and_save_file($req, $benchmark, 'top_pic');
            }

            // benchmark_suppliers
            $request_data['benchmark_suppliers'] = array_map(function($url_sup, $genzairyo_sup){
                return [
                    'url' => $url_sup,
                    'genryo_mei' => $genzairyo_sup,
                    'del_flg' => config('constant.flg.no'),
                    'crt_pg_id' => self::PG_ID,
                    'upd_pg_id' => self::PG_ID,
                ];}, $request_data['url_sup'], $request_data['genzairyo_sup']);
            $benchmark->benchmark_suppliers()->delete();
            $benchmark->benchmark_suppliers()->createMany ($request_data['benchmark_suppliers']);

            // benchmark_genryo
            $benchmark->benchmark_genryo()->sync(array_fill_keys($request_data['benchmark_genryo'], [
                'del_flg' => config('constant.flg.no'),
                'crt_usr_id' => Auth::user()->id,
                'crt_pg_id' => self::PG_ID,
                'upd_usr_id' => Auth::user()->id,
                'upd_pg_id' => self::PG_ID,
            ]));

            $benchmark->save();

            DB::commit();
            return redirect("/manage/benchmark/{$benchmark->bench_cd}/edit")->withInput()->with('success_message', sprintf(config('message.action_success'), '新規登録'));
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
            'top_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meyasu' => 'digits_between:0,255',
            'kn' => 'digits_between:0,255',
            'sale_kn' => 'digits_between:0,255',
            'day_kn' => 'digits_between:0,255',
            'hanbai_nm' => 'max:255',
            'item_nm' => 'max:255',
            'meyasu' => 'max:255',
            'kn' => 'max:255',
            'sale_kn' => 'max:255',
            'day_kn' => 'max:255',
            'shuseibun' => 'max:255',
            'genzairyo_nm' => 'max:2000',
            'yukoseibun' => 'max:1000',
            'juryo' => 'max:255',
            'naiyoryo' => 'max:255',
            'site' => 'max:2000',
            'tokucho' => 'max:2000',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->witherrors($validator)->with(['keep_input' => true]);
        }

        $benchmark = M500Benchmark::find($req->bench_cd);
        if (isset($benchmark)) {

            DB::beginTransaction();
            try {
                $request_data = array_merge($benchmark->default_values, $req->all());
                $benchmark->fill($request_data);
                $benchmark->after_fill_update($req, self::PG_ID);

                // mokuteki_categories1
                $benchmark->mokuteki_categories1()->sync(array_fill_keys($request_data['mokuteki_categories1'], [
                    'del_flg' => config('constant.flg.no'),
                    'crt_usr_id' => Auth::user()->id,
                    'crt_pg_id' => self::PG_ID,
                    'upd_usr_id' => Auth::user()->id,
                    'upd_pg_id' => self::PG_ID,
                ]));

                // top_pic
                if ($req->is_updated_pict) {
                    $this->upload_and_save_file($req, $benchmark, 'top_pic');
                }

                // benchmark_suppliers
                $request_data['benchmark_suppliers'] = array_map(function($url_sup, $genzairyo_sup){
                    return [
                        'url' => $url_sup,
                        'genryo_mei' => $genzairyo_sup,
                        'del_flg' => config('constant.flg.no'),
                        'crt_pg_id' => self::PG_ID,
                        'upd_pg_id' => self::PG_ID,
                    ];}, $request_data['url_sup'], $request_data['genzairyo_sup']);
                $benchmark->benchmark_suppliers()->delete();
                $benchmark->benchmark_suppliers()->createMany ($request_data['benchmark_suppliers']);

                // benchmark_genryo
                $benchmark->benchmark_genryo()->sync(array_fill_keys($request_data['benchmark_genryo'], [
                    'del_flg' => config('constant.flg.no'),
                    'crt_usr_id' => Auth::user()->id,
                    'crt_pg_id' => self::PG_ID,
                    'upd_usr_id' => Auth::user()->id,
                    'upd_pg_id' => self::PG_ID,
                ]));


                $benchmark->save();

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
