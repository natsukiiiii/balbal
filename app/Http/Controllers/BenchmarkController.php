<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M500Benchmark;
use App\Models\M503MokutekiCateCh;
use App\Models\M504MokutekiCategory1;
use App\Models\M470Seibun;
use App\Models\M005Code;

class BenchmarkController extends Controller
{
	const PER_PAGE = 6;

	/**
	 * Show Main & Search screen
	 * @param Request $req 
	 * @return type
	 */
    public function index(Request $req) {
        $this->tag_object = config('tags.benchmark.default');
        $search_by_list = [];
        $search_by_text = config('constant.benchmark.search_by_text.default');

    	// validation

    	// search
    	$benchmark_list = M500Benchmark::where('del_flg', config('constant.flg.no'));
        if (isset($req->zaikei)) {
            $benchmark_list = $benchmark_list->whereRaw("CONCAT(',', `zaikei`, ',') REGEXP ',(".$req->zaikei."),'");
            $zaikei_text = $this->get_name_from_master_list_by_id('zaikei_bench_master_list', $req->zaikei);
            $search_by_list[] = $zaikei_text;
        }
        if (isset($req->category)) {
    		$benchmark_list = $benchmark_list->whereHas('mokuteki_categories1', function ($q) use ($req) {
    			$q->where(M504MokutekiCategory1::getTableName().'.mokuteki_cate_cd', '=', $req->category);
            });
            // $benchmark_list = $benchmark_list->whereIn('bench_cd', function ($q) use ($req) {
            //     $q->select('bench_cd')
            //         ->from(M503MokutekiCateCh::getTableName())
            //         ->where('mokuteki_cate_cd', '=', $req->category)
            //         ->where('del_flg', config('constant.flg.no'));
            // });
            $category_text = $this->get_name_from_master_list_by_id('mokuteki_cate_master_list', $req->category);
            $search_by_list[] = $category_text;
        }
        if (isset($req->genryo)) {
            $benchmark_list = $benchmark_list->whereHas('benchmark_genryo', function ($q) use ($req) {
    			$q->where(M470Seibun::getTableName().'.seibun_cd', '=', $req->genryo);
            });
            $category_text = $this->get_name_from_master_list_by_id('seibun_master_list', $req->genryo);
            $search_by_list[] = $category_text;
        }
    	if (isset($req->keyword)) {
            $zaikei_cd = M005Code::where('code_id','ZAIKEI_BENCH')
                                ->where('code_nm', 'like', '%' . $req->keyword . '%')
                                ->where('del_flg', config('constant.flg.no'))->pluck('code')->toArray();
                               
    		$benchmark_list = $benchmark_list->where(function($q) use ($req, $zaikei_cd) {
			    $q->where('hanbai_nm', 'like', '%' . $req->keyword . '%')
			        ->orWhere('item_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('genzairyo_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('shuseibun', 'like', '%' . $req->keyword . '%')
                    ->orWhere(function($q) use ($req) {
                        $q->whereIn('bench_cd', function($q) use ($req) {
                            $q->select('bench_cd')->distinct()
                                ->from(with(new M503MokutekiCateCh)->getTable())
                                ->whereIn('mokuteki_cate_cd', function($q) use ($req) {
                                    $q->select('mokuteki_cate_cd')
                                        ->from(with(new M504MokutekiCategory1)->getTable())
                                        ->where('mokuteki_cate_nm', 'like', '%' . $req->keyword . '%')
                                        ->get();
                                })
                                ->get();
                        });
                    });
                if (count($zaikei_cd) > 0) {
                    $q->orWhereRaw("CONCAT(',', `zaikei`, ',') REGEXP ',(".implode('|', $zaikei_cd)."),'");
                }
			});
            // $benchmark_list_2 = $benchmark_list->whereHas('mokuteki_categories1', function ($q) use ($req) {
            //     $q->where(M504MokutekiCategory1::getTableName().'.mokuteki_cate_nm', 'like', '%' . $req->keyword . '%');
            // });
            // $benchmark_list= $benchmark_list_1->union($benchmark_list_2);
        }
        $benchmark_list = $benchmark_list->orderBy('crt_date', 'DESC');
    	$benchmark_list = $benchmark_list->paginate(self::PER_PAGE);

        // adjust tags
        if (isset($category_text)) {
            $this->tag_object['title'] = strtr(config('tags.benchmark.category.title'), ['@category' => $category_text]);
            $this->tag_object['description'] = strtr(config('tags.benchmark.category.description'), ['@category' => $category_text]);
            $this->tag_object['keyword'] = strtr(config('tags.benchmark.category.keyword'), ['@category' => $category_text]);
            $this->tag_object['h1'] = config('tags.benchmark.category.h1');
        }

    	session()->flashInput($req->input());
        if (count($search_by_list) > 0) {
            $search_by_text = implode('、', $search_by_list) . config('constant.benchmark.search_by_text.suffix');
        }

        if (isset($req->is_ajax)) {
            return view(
                'benchmark.index_items_only', [
                    'benchmark_list' => $benchmark_list,
                ]
            );
        }

    	return view(
    		'benchmark.index', [
                'tag_object' => $this->tag_object,
                'benchmark_list' => $benchmark_list,
                'search_by_text' => $search_by_text,
            ]
    	);
    }

    /**
     * Show benchmark detail page
     * @param Request $req 
     * @return type
     */
    public function get_detail(Request $req) {
        $this->tag_object = config('tags.benchmark_detail.default');

        $benchmark = M500Benchmark::where('del_flg', config('constant.flg.no'))
            ->find($req->benchmark_cd);

        $benchmark_genryo_list = [];
        if ($benchmark) {
            foreach ($benchmark->benchmark_genryo as $seibun) {
                foreach (view()->shared('seibun_master_list') as $seibun_master) {
                    if($seibun_master->seibun_cd == $seibun->seibun_cd){
                        $benchmark_genryo_list[] = $seibun_master;
                        break;
                    }
                }
            }
            $this->tag_object['title'] = strtr(config('tags.benchmark_detail.found.title'), [
                '@hanbai_nm' => $benchmark->hanbai_nm, 
                '@item_nm' => $benchmark->item_nm
            ]);
            $this->tag_object['description'] = strtr(config('tags.benchmark_detail.found.description'), [
                '@shuseibun' => $benchmark->shuseibun,
                '@hanbai_nm' =>$benchmark->hanbai_nm ,
                '@item_nm' => $benchmark->item_nm
               
            ]);
            $this->tag_object['keyword'] = strtr(config('tags.benchmark_detail.found.keyword'), [
                '@shuseibun' => $benchmark->shuseibun,
                '@item_nm' => $benchmark->item_nm,
                '@hanbai_nm' => $benchmark->hanbai_nm, 
                '@mokuteki_cate_nm' => implode(',', $benchmark->mokuteki_categories1->pluck('mokuteki_cate_nm')->toArray())
            ]);
          
        }
    	return view(
            'benchmark.detail', [
                'tag_object' => $this->tag_object,
                'benchmark' => $benchmark,
                'benchmark_genryo_list' => $benchmark_genryo_list,
            ]
        );
    }

    /**
     * Show compare between benchmark item using bench_id
     * @param Request $req 
     * @return type
     */
    public function get_compare(Request $req) {
        $benchmark_list = M500Benchmark::where('del_flg', config('constant.flg.no'));
        if (isset($req->id)) {
            $req->id = array_filter($req->id);
            $order = 'FIELD(bench_cd,'.implode(',', $req->id).')';
            $benchmark_list = $benchmark_list->whereIn('bench_cd', $req->id)->orderByRaw($order)->get();
        }
        return view(
            'benchmark.compare', [
                'tag_object' => $this->tag_object,
                'benchmark_list' => $benchmark_list,
            ]
        );
    }
}
