<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M300Kinosei;
use App\Models\M301KinoseiCategory;
use App\Models\M310KinoseiCategoryCn;

class FoodController extends Controller
{
	const PER_PAGE = 20;

	/**
	 * Show Main & Search screen
	 * @param Request $req 
	 * @return type
	 */
    public function index(Request $req) {
        $this->tag_object = config('tags.food.default');
        $search_by_list = [];
        $search_by_text = config('constant.food.search_by_text.default');

    	// validation

    	// search
    	$function_list = M300Kinosei::where('del_flg', config('constant.flg.no'))
            ->where('up_contents', config('constant.flg.yes'));
    	if (isset($req->kanyo)) {
            $function_list = $function_list->whereRaw('FIND_IN_SET(?, search_kanyo)', $req->kanyo);
            $category_text = $this->get_name_from_master_list_by_id('kinosei_shokuhin_master_list', $req->kanyo);
            $search_by_list[] = $category_text;
        }
        if (isset($req->category)) {
            // $function_list = $function_list->whereHas('kinosei_categories', function ($q) use ($req) {
    		// 	$q->where(M301KinoseiCategory::getTableName().'.kinosei_category_cd', '=', $req->category);
            // });
            $function_list = $function_list->whereIn('kinosei_cd', function ($q) use ($req) {
                $q->select('kinosei_cd')
                    ->from(M310KinoseiCategoryCn::getTableName())
                    ->where('kinosei_category_cd', '=', $req->category)
                    ->where('del_flg', config('constant.flg.no'));
            });
            
            $category_text = $this->get_name_from_master_list_by_id('kinosei_category_master_list', $req->category);
            $search_by_list[] = $category_text;
    	}
    	if (isset($req->keyword)) {
    		$function_list = $function_list->where(function($q) use ($req) {
                $q->where('hyoji_kinosei', 'like', '%' . $req->keyword . '%')
                    ->orWhere('item_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('kanyo_seibun_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('todokede_no', 'like', '%' . $req->keyword . '%')
                    ->orWhere('todokede_nm', 'like', '%' . $req->keyword . '%');
			});
    	}
    	$function_list = $function_list->orderByRaw('kinosei_cd DESC')->paginate(self::PER_PAGE);

        // adjust tags
        if (isset($category_text)) {
            $this->tag_object['title'] = strtr(config('tags.food.category.title'), ['@category' => $category_text]);
            $this->tag_object['description'] = strtr(config('tags.food.category.description'), ['@category' => $category_text]);
            $this->tag_object['keyword'] = strtr(config('tags.food.category.keyword'), ['@category' => $category_text]);
            $this->tag_object['h1'] = config('tags.food.category.h1');
        }

    	session()->flashInput($req->input());
        if (count($search_by_list) > 0) {
            $search_by_text = implode('、', $search_by_list) . config('constant.food.search_by_text.suffix');
        }

    	return view(
    		'food.index', [
                'tag_object' => $this->tag_object,
                'function_list' => $function_list,
                'search_by_text' => $search_by_text,
            ]
    	);
    }

    /**
     * Show Food detail page
     * @param Request $req 
     * @return type
     */
    public function get_detail(Request $req) {
        $this->tag_object = config('tags.food_detail.default');

        $function = M300Kinosei::where('del_flg', config('constant.flg.no'))
            ->where('up_contents', config('constant.flg.yes'))
            ->find($req->kinosei_cd);

        $kinosei_shokuhin_list = [];
        if ($function) {
            foreach ($function->kinosei_shokuhin as $kinosei_shokuhin_cd) {
                foreach (view()->shared('kinosei_shokuhin_master_list') as $kinosei_shokuhin_master) {
                    if ($kinosei_shokuhin_master->kinosei_stg_cd == $kinosei_shokuhin_cd) {
                        $kinosei_shokuhin_list[] = $kinosei_shokuhin_master;
                        break;
                    }
                }
            }

            // adjust tags
            $this->tag_object['title'] = strtr(config('tags.food_detail.found.title'), ['@item_nm' => $function->item_nm]);
            $this->tag_object['description'] = strtr(config('tags.food_detail.found.description'), ['@item_nm' => $function->item_nm]);
            $this->tag_object['keyword'] = strtr(config('tags.food_detail.found.keyword'), [
                '@item_nm' => $function->item_nm,
                '@kinosei_category' => implode(',', $function->kinosei_categories->pluck('kinosei_category')->toArray()),
                '@todokede_no' => $function->todokede_no,
                '@todokede_nm' => $function->todokede_nm,
                '@kanyo_seibun' => implode(',', collect($kinosei_shokuhin_list)->pluck('kinosei_stg')->toArray()),
            ]);
        }

    	return view(
            'food.detail', [
                'tag_object' => $this->tag_object,
                'function' => $function,
                'kinosei_shokuhin_list' => $kinosei_shokuhin_list,
            ]
        );
    }
}
