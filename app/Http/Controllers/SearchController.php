<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Auth;
use App\Models\M470Seibun;

class SearchController extends Controller
{
    public function index(Request $req, $type, $seibun_mei) {
		$seibun_list = M470Seibun::whereIn('50_order', config('constant.seibun_mei_map')[$seibun_mei])
			->where('del_flg', '=', config('constant.flg.no'))
			->orderBy('order_by','ASC')
			->get();
    	return view(
    		'search.index', [
    			'seibun_mei' => $seibun_mei,
    			'seibun_list' => $seibun_list,
    			'type' => $type,
    		]
    	);
    }
}
