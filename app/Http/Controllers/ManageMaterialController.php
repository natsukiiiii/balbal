<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;

use App\Models\M400Genryo;
use App\Models\M200Company;

class ManageMaterialController extends Controller
{
    // Page_ID
    const PG_ID = 'ManageMaterialController';

    /**
	 * Show Main & Search screen
	 * @param Request $req 
	 * @return type
	 */
    public function index(Request $req)
    {
    	// validate
        
        // init value
        // if (!isset($req->search_mode)) {
        //     $req->merge(['included_deleted' => true]);
        // }

    	// search
    	$material_list = M400Genryo::select('*');
    	if (isset($req->item_nm)) {
    		$material_list = $material_list->where('item_nm', 'like', '%' . $req->item_nm . '%');
    	}
    	if (isset($req->ippan_nm)) {
    		$material_list = $material_list->where('ippan_nm', 'like', '%' . $req->ippan_nm . '%');
    	}
    	if (isset($req->kigyo_cd)) {
    		$material_list = $material_list->where('kigyo_cd', '=', $req->kigyo_cd);	
    	}
    	if (!isset($req->included_deleted)) {
    		$material_list = $material_list->where('del_flg', '=', config('constant.flg.no'));	
    	}
    	$material_list = $material_list->orderByRaw('genryo_id + 0')->paginate();

    	session()->flashInput($req->input());
    	return view(
            'manage.material.index',
            compact('material_list')
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
        return view('manage.material.create_or_edit', [
            'mode' => 'create',
        ]);
    }

    /**
     * Show edit page
     * {genryo_id}/edit
     * @param string $genryo_id 
     * @return type
     */
    public function edit(Request $req, $genryo_id) 
    {
        $material = M400Genryo::find($genryo_id);
        return view('manage.material.create_or_edit', [
            'mode' => 'edit',
            'material' => $material,
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
            // 'genryo_id' => 'required|max:10|unique:m400_genryo',
            'top_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hitokoto' => 'max:80',
            'item_gaiyo_title' => 'max:50',
            'item_gaiyo' => 'max:1000',
            'item_nm' => 'required|max:255',
            'ippan_nm' => 'required|max:255',
            'ippan_nm_kana' => 'required|max:255',
            'hanbai_shutai' => 'required|max:255',
            'kigyo_cd' => 'required|max:255',
            // 'seibun_nm' => 'required|max:255',
            'jokyo' => 'required|max:255',
            'genryo_ex' => 'required|max:255',
            'naiyo' => 'required|max:255',
            'kubun' => 'required|max:255',
            'kaigai' => 'required|max:255',
            'pet' => 'required|max:255',
            'logo_pic1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_pic2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seijo' => 'required|max:255',
            'suiyosei' => 'required|max:255',
            'yuyosei' => 'required|max:255',
            'allergie' => 'required|max:255',
            'gmo_info' => 'required|max:255',
            'anzen_data' => 'required|max:255',
            'evidence' => 'required|max:255',
            'gensankoku' => 'required|max:255',
            'saishu_koku' => 'required|max:255',
            'path' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx,ppt,pptx,7z,zip,rar,pdf,csv,htm,html,txt,text',
            'path2' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx,ppt,pptx,7z,zip,rar,pdf,csv,htm,html,txt,text',
            'path3' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx,ppt,pptx,7z,zip,rar,pdf,csv,htm,html,txt,text',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->witherrors($validator);
        }

        DB::beginTransaction();
        try {
            // fill data from request
            $material = new M400Genryo();
            $request_data = array_merge($material->default_values, $req->all());
            $material->fill($request_data);
            $material->after_fill_insert($req, self::PG_ID);
            // $material->genryo_id = $req->genryo_id;
            $material->save(); // to get the new genryo_id

            //公開フラグ up_contents
            $material->up_contents = isset($req->up_contents) ? config('constant.flg.yes') : config('constant.flg.no');

            //公開フラグ top_random
            $material->top_random = isset($req->top_random) ? config('constant.flg.yes') : config('constant.flg.no');

            // おすすめ原料　rec_genryo
            $material->rec_genryo = isset($req->rec_genryo) ? config('constant.flg.yes') : config('constant.flg.no');

            // top_pic
            if ($req->is_updated_pict) {
                $this->upload_and_save_file($req, $material, 'top_pic');
            }
            // logo_pic1
            if ($req->is_updated_logo1) {
                $this->upload_and_save_file($req, $material, 'logo_pic1');
            }
            // logo_pic2
            if ($req->is_updated_logo2) {
                $this->upload_and_save_file($req, $material, 'logo_pic2');
            }

            // sokyu_categories
            $request_data['sokyu_categories'] = array_map(function($sokyu_koka1, $sokyu_koka2, $sokyu_koka3){
                return [
                    'sokyu_cate_cd' => $sokyu_koka1 ? $sokyu_koka1 : '',
                    'sokyu_cate2_cd' => $sokyu_koka2 ? $sokyu_koka2 : '',
                    'sokyu_cate3_cd' => $sokyu_koka3 ? $sokyu_koka3 : '',
                    'del_flg' => config('constant.flg.no'),
                    'crt_pg_id' => self::PG_ID,
                    'upd_pg_id' => self::PG_ID,
                ];}, $request_data['sokyu_koka1'], $request_data['sokyu_koka2'], $request_data['sokyu_koka3']);
            $material->sokyu_categories()->delete();
            $material->sokyu_categories()->createMany($request_data['sokyu_categories']);
            
            // genryo_links
            $request_data['genryo_links'] = array_map(function($url, $link_mei){
                return [
                    'url' => $url,
                    'link_mei' => $link_mei,
                    'del_flg' => config('constant.flg.no'),
                    'crt_pg_id' => self::PG_ID,
                    'upd_pg_id' => self::PG_ID,
                ];}, $request_data['url'], $request_data['link_mei']);
            $material->genryo_links()->delete();
            $material->genryo_links()->createMany ($request_data['genryo_links']);

            // genryo doc
            if ($req->is_updated_path) {
                $this->upload_and_save_file($req, $material, 'path', 'gdoc');
            }
            if ($req->is_updated_path2) {
                $this->upload_and_save_file($req, $material, 'path2', 'gdoc');
            }
            if ($req->is_updated_path3) {
                $this->upload_and_save_file($req, $material, 'path3', 'gdoc');
            }

            $material->save();

            DB::commit();
            return redirect("/manage/material/{$material->genryo_id}/edit")->withInput()->with('success_message', sprintf(config('message.action_success'), '新規登録'));
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
            'hitokoto' => 'max:80',
            'item_gaiyo_title' => 'max:50',
            'item_gaiyo' => 'max:1000',
            'item_nm' => 'required|max:255',
            'ippan_nm' => 'required|max:255',
            'ippan_nm_kana' => 'required|max:255',
            'hanbai_shutai' => 'required|max:255',
            'kigyo_cd' => 'required|max:255',
            // 'seibun_nm' => 'required|max:255',
            'jokyo' => 'required|max:255',
            'genryo_ex' => 'required|max:255',
            'naiyo' => 'required|max:255',
            'kubun' => 'required|max:255',
            'kaigai' => 'required|max:255',
            'pet' => 'required|max:255',
            'logo_pic1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'logo_pic2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seijo' => 'required|max:255',
            'suiyosei' => 'required|max:255',
            'yuyosei' => 'required|max:255',
            'allergie' => 'required|max:255',
            'gmo_info' => 'required|max:255',
            'anzen_data' => 'required|max:255',
            'evidence' => 'required|max:255',
            'gensankoku' => 'required|max:255',
            'saishu_koku' => 'required|max:255',
            'path' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx,ppt,pptx,7z,zip,rar,pdf,csv,htm,html,txt,text',
            'path2' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx,ppt,pptx,7z,zip,rar,pdf,csv,htm,html,txt,text',
            'path3' => 'file|mimes:jpeg,png,jpg,gif,svg,doc,docx,xls,xlsx,ppt,pptx,7z,zip,rar,pdf,csv,htm,html,txt,text',
            

        ]);
        if ($req->is_updated_pict) {
            $validator = \Validator::make($req->all(), [
                'top_pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }
        // if (!$req->sokyu_koka1) {
        //     $is_custom_valid = false;
        //     $validator->getMessageBag()->add('sokyu_categories', '訴求効果は必須です。');
        // }
        if ($validator->fails()) {
            return back()->withInput()->witherrors($validator)->with(['keep_input' => true]);
        }

        $material = M400Genryo::find($req->genryo_id);
        if (isset($material)) {

            DB::beginTransaction();
            try {

                $request_data = array_merge($material->default_values, $req->all());
                $material->fill($request_data);
                $material->after_fill_update($req, self::PG_ID);

                //公開フラグ up_contents
                $material->up_contents = isset($req->up_contents) ? config('constant.flg.yes') : config('constant.flg.no');

                //公開フラグ top_random
                $material->top_random = isset($req->top_random) ? config('constant.flg.yes') : config('constant.flg.no');

                // おすすめ原料　rec_genryo
                $material->rec_genryo = isset($req->rec_genryo) ? config('constant.flg.yes') : config('constant.flg.no');

                // top_pic
                if ($req->is_updated_pict) {
                    $this->upload_and_save_file($req, $material, 'top_pic');
                }
                // logo_pic1
                if ($req->is_updated_logo1) {
                    $this->upload_and_save_file($req, $material, 'logo_pic1');
                }
                // logo_pic2
                if ($req->is_updated_logo2) {
                    $this->upload_and_save_file($req, $material, 'logo_pic2');
                }

                // sokyu_categories
                $request_data['sokyu_categories'] = array_map(function($sokyu_koka1, $sokyu_koka2, $sokyu_koka3){
                    return [
                        'sokyu_cate_cd' => $sokyu_koka1 ? $sokyu_koka1 : '',
                        'sokyu_cate2_cd' => $sokyu_koka2 ? $sokyu_koka2 : '',
                        'sokyu_cate3_cd' => $sokyu_koka3 ? $sokyu_koka3 : '',
                        'del_flg' => config('constant.flg.no'),
                        'crt_pg_id' => self::PG_ID,
                        'upd_pg_id' => self::PG_ID,
                    ];}, $request_data['sokyu_koka1'], $request_data['sokyu_koka2'], $request_data['sokyu_koka3']);
                if (count(array_unique($request_data['sokyu_categories'], SORT_REGULAR)) < count($request_data['sokyu_categories'])) {
                    DB::rollback();
                    $validator->getMessageBag()->add('sokyu_categories', 'その訴求効果はすでに使われています。');
                    return back()->withInput()->witherrors($validator)->with(['keep_input' => true]);
                }
                $material->sokyu_categories()->delete();
                $material->sokyu_categories()->createMany($request_data['sokyu_categories']);

                // genryo_links
                $request_data['genryo_links'] = array_map(function($url, $link_mei){
                    return [
                        'url' => $url,
                        'link_mei' => $link_mei,
                        'del_flg' => config('constant.flg.no'),
                        'crt_pg_id' => self::PG_ID,
                        'upd_pg_id' => self::PG_ID,
                    ];}, $request_data['url'], $request_data['link_mei']);
                $material->genryo_links()->delete();
                $material->genryo_links()->createMany ($request_data['genryo_links']);

                // genryo doc
                if ($req->is_updated_path) {
                    $this->upload_and_save_file($req, $material, 'path', 'gdoc');
                }
                if ($req->is_updated_path2) {
                    $this->upload_and_save_file($req, $material, 'path2', 'gdoc');
                }
                if ($req->is_updated_path3) {
                    $this->upload_and_save_file($req, $material, 'path3', 'gdoc');
                }

                $material->save();

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
