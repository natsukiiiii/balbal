<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M412SokyuCategory2;
use App\Models\M413SokyuCategory3;

class AjaxController extends Controller
{
    /**
     * Get sokyu_category_2 by sokyu_cate_cd
     * @param type $request
     * @return type
     */
    public function get_sokyu_category_2($sokyu_cate_cd)
    {
        $sokyu_cate2 = M412SokyuCategory2::select(['sokyu_cate2_cd', 'sokyu_cate2_nm'])
            ->where('del_flg', config('constant.flg.no'))
            ->where('sokyu_cate_cd', $sokyu_cate_cd)->orderByRaw('sokyu_cate2_cd + 0')
            ->get();
        // echo "asdasdsad";
        return response()->json($sokyu_cate2);
    }

    /**
     * Get sokyu_category_3 by sokyu_cate2_cd
     * @param type $request
     * @return type
     */
    public function get_sokyu_category_3($sokyu_cate2_cd)
    {
        $sokyu_cate3 = M413SokyuCategory3::select(['sokyu_cate3_cd', 'sokyu_cate3_nm'])
            ->where('del_flg', config('constant.flg.no'))
            ->where('sokyu_cate2_cd', $sokyu_cate2_cd)->orderByRaw('sokyu_cate3_cd + 0')
            ->get();
        return response()->json($sokyu_cate3);
    }
}
