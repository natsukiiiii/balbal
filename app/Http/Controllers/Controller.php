<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;
use Illuminate\Support\Facades\Cache;
use App\Models\M200Company;
use App\Models\M301KinoseiCategory;
use App\Models\M005Code;
use App\Models\M302KinoseiCategoryGenryo;
use App\Models\M421YotoCategory1;
use App\Models\M411SokyuCategory1;
use App\Models\M412SokyuCategory2;
use App\Models\M413SokyuCategory3;
use App\Models\M470Seibun;
use App\Models\M504MokutekiCategory1;
use App\Models\M440Sokyubui;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Preload all master data
     * Note: Need something like cache here.
     * @return type
     */
    public function __construct()
	{
		// default tag values
		$this->tag_object = config('tags.top.default');

		// Sharing in views
		View::share('kigyo_master_list', Cache::remember('kigyo_master_list', config('constant.cache_timeout'), function () {
    		return M200Company::where('del_flg', config('constant.flg.no'))->orderBy('kigyo_nm')->get();
		}));
		View::share('kinosei_category_master_list', Cache::remember('kinosei_category_master_list', config('constant.cache_timeout'), function () {
    		return M301KinoseiCategory::where('del_flg', config('constant.flg.no'))->orderByRaw('kinosei_category_cd + 0')->get();
		}));
		View::share('kinosei_shokuhin_master_list', Cache::remember('kinosei_shokuhin_master_list', config('constant.cache_timeout'), function () {
    		return M302KinoseiCategoryGenryo::where('del_flg', config('constant.flg.no'))->orderBy('kinosei_stg')->get();
		}));
		View::share('shokuten_master_list', Cache::remember('shokuten_master_list', config('constant.cache_timeout'), function () {
    		return M421YotoCategory1::where('del_flg', config('constant.flg.no'))->orderByRaw('yoto_cate_cd + 0')->get();
		}));
		View::share('sokyu_cate_master_list', Cache::remember('sokyu_cate_master_list', config('constant.cache_timeout'), function () {
    		return M411SokyuCategory1::where('del_flg', config('constant.flg.no'))->orderByRaw('order_by + 0, sokyu_cate_cd + 0')->get();
		}));
		View::share('sokyu_cate2_master_list', Cache::remember('sokyu_cate2_master_list', config('constant.cache_timeout'), function () {
    		return M412SokyuCategory2::where('del_flg', config('constant.flg.no'))->orderByRaw('sokyu_cate2_cd + 0')->get();
		}));
		View::share('sokyu_cate3_master_list', Cache::remember('sokyu_cate3_master_list', config('constant.cache_timeout'), function () {
    		return M413SokyuCategory3::where('del_flg', config('constant.flg.no'))->orderByRaw('sokyu_cate3_cd + 0')->get();
		}));
		View::share('seibun_master_list', Cache::remember('seibun_master_list', config('constant.cache_timeout'), function () {
    		return M470Seibun::where('del_flg', config('constant.flg.no'))->orderBy('order_by')->get();
		}));
		View::share('mokuteki_cate_master_list', Cache::remember('mokuteki_cate_master_list', config('constant.cache_timeout'), function () {
    		return M504MokutekiCategory1::where('del_flg', config('constant.flg.no'))->orderByRaw('order_by + 0')->get();
		}));
		View::share('sokyu_bui_master_list', Cache::remember('sokyu_bui_master_list', config('constant.cache_timeout'), function () {
    		return M440Sokyubui::where('del_flg', config('constant.flg.no'))->orderByRaw('order_by + 0')->get();
		}));
		foreach ([
			'hanbai_shutai_master_list' => 'HANBAI_SHUTAI',
			'jokyo_master_list' => 'JOKYO',
			'kyokyu_master_list' => 'KYOKYU',
			'kubun_master_list' => 'KUBUN',
			'zaikei_master_list' => 'ZAIKEI',
			'chaina_master_list' => 'CHAINA',
			'kaigai_master_list' => 'KAIGAI',
			'pet_master_list' => 'PET',
			'shohyo_logo_master_list' => 'SHOHYO_LOGO',
			'seijo_master_list' => 'SEIJO',
			'suiyosei_master_list' => 'SUIYOSEI',
			'yuyosei_master_list' => 'YUYOSEI',
			'allergie_master_list' => 'ALLERGIE',
			'gmo_info_master_list' => 'GMO_INFO',
			'anzen_data_master_list' => 'ANZEN_DATA',
			'evidence_master_list' => 'EVIDENCE',
			'tokuho_master_list' => 'TOKUHO',
			'gensankoku_master_list' => 'JAPAN',
			'saishu_koku_master_list' => 'OVERSEAS',
			'zaikei_bench_master_list' => 'ZAIKEI_BENCH',
			'shurui_master_list' => 'SHURUI',
		] as $key => $value) {
			View::share($key, Cache::remember($key, config('constant.cache_timeout'), function () use ($value) {
	    		return M005Code::where('code_id', $value)->where('del_flg', config('constant.flg.no'))->orderByRaw('sort_no + 0')->get();
			}));
		}
		View::share('ninsho_master_list', Cache::remember('ninsho_master_list', config('constant.cache_timeout'), function () {
    		return M005Code::where('code_id', 'NINSHO')
    			->whereNull('moji_1')
    			->where('del_flg', config('constant.flg.no'))
    			->orderByRaw('sort_no + 0')->get();
		}));
		View::share('ninsho_halal_kosher_master_list', Cache::remember('ninsho_halal_kosher_master_list', config('constant.cache_timeout'), function () {
    		return M005Code::where('code_id', 'NINSHO')
    			->where('moji_1', 'halal_kosher')
    			->where('del_flg', config('constant.flg.no'))
    			->orderByRaw('sort_no + 0')->get();
		}));
		View::share('all_ninsho_master_list_array', Cache::remember('all_ninsho_master_list_array', config('constant.cache_timeout'), function() {
			return array_merge(view()->shared('ninsho_master_list')->toArray(), view()->shared('ninsho_halal_kosher_master_list')->toArray());
		}));
		View::share('seibun_mei_map_list', config('constant.seibun_mei_map'));
	}

	/**
	 * Move file(image/document) to configured server location then save new image/document name to model
	 * Must call this function when processing upload image / file field
	 * @param type $request 
	 * @param type $model 
	 * @param type $input_name 
	 * @param type $type ('img','gdoc') 
	 * @return type
	 */
	public function upload_and_save_file($request, $model, $input_name, $type = 'img') {
		$model->{$input_name} = '';
		if ($request->hasFile($input_name)) {
		    $file = $request->file($input_name); 
			$new_file_name = time() . '_' . bin2hex(openssl_random_pseudo_bytes(10)) . '.' . $file->getClientOriginalName();
			// $new_file_name = time() . '_' . bin2hex(openssl_random_pseudo_bytes(10)) . '.' . \File::extension($file->getClientOriginalName());
		    $save_path = '';
		    switch ($type) {
		    	case 'img':
		    		$save_path = config('app.upload_image_folder');
		    		break;
		    	case 'gdoc':
		    		$save_path = config('app.upload_genryodoc_folder').'/'.$request->genryo_id;
		    		$new_file_name = $save_path.'/'.$new_file_name;
		    		break;
		    	
		    	default:
		    		$save_path = config('app.upload_image_folder');
		    		break;
		    }
		    $file->move(public_path($save_path), $new_file_name);
		    $model->{$input_name} = $new_file_name;
		}
	}

	/**
	 * Get the name from master list by id, return null if not found
	 * @param type $category_level 
	 * @param type $search_id 
	 * @return type
	 */
	public function get_name_from_master_list_by_id($master_list_name = '', $search_id, $category_level = 1) {
		switch ($master_list_name) {
			case '':
				$master_list = view()->shared('sokyu_cate_master_list');
		        $key = 'sokyu_cate_cd';
		        $value = 'sokyu_cate_nm';
				switch ($category_level) {
					case 2:
					case 3:
						$master_list = view()->shared("sokyu_cate{$category_level}_master_list");
						$key = "sokyu_cate{$category_level}_cd";
						$value = "sokyu_cate{$category_level}_nm";
						break;
				}
				break;
			case 'sokyu_bui_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'sokyu_bui_cd';
				$value = 'sokyu_bui_nm';
				break;
			case 'shokuten_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'yoto_cate_cd';
				$value = 'yoto_cate_nm';
				break;
			case 'seibun_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'seibun_cd';
				$value = 'seibun_header';
				break;
			case 'kinosei_shokuhin_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'kinosei_stg_cd';
				$value = 'kinosei_stg';
				break;
			case 'kinosei_category_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'kinosei_category_cd';
				$value = 'kinosei_category';
				break;
			case 'mokuteki_cate_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'mokuteki_cate_cd';
				$value = 'mokuteki_cate_nm';
				break;
			case 'zaikei_bench_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'code';
				$value = 'code_nm';
				break;
			case 'hanbai_shutai_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'code';
				$value = 'code_nm';
				break;
			default:
				return null;
				break;
		}


		foreach ($master_list as $master) {
			// if $search_is is an array, return the first result that matches with first element of $search_id array
			if (is_array($search_id)) {
				if (in_array($master[$key], $search_id)) {
					return $master[$value];
				}
			} else {
				if ($master[$key] == $search_id) {
					return $master[$value];
				}
			}
		}
		return null;
	}

	/**
	 * Get the id from master list by name, return null if not found
	 * @param type $category_level 
	 * @param type $search_id 
	 * @return type
	 */
	public function get_id_from_master_list_by_name($master_list_name = '', $search_name, $category_level = 1) {
		switch ($master_list_name) {
			case '':
				$master_list = view()->shared('sokyu_cate_master_list');
		        $key = 'sokyu_cate_nm';
		        $value = 'sokyu_cate_cd';
				switch ($category_level) {
					case 2:
					case 3:
						$master_list = view()->shared("sokyu_cate{$category_level}_master_list");
						$key = "sokyu_cate{$category_level}_nm";
						$value = "sokyu_cate{$category_level}_cd";
						break;
				}
				break;
			case 'pet_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'code_nm';
				$value = 'code';
				break;
			case 'kaigai_master_list':
				$master_list = view()->shared($master_list_name);
				$key = 'code_nm';
				$value = 'code';
				break;
			default:
				return null;
				break;
		}

		foreach ($master_list as $master) {
			if ($master[$key] == $search_name) {

				return $master[$value];
			}
		}
		return null;
	}
}