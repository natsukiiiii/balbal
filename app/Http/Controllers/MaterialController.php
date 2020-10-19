<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\M200Company;
use App\Models\M400Genryo;
use App\Models\M005Code;

class MaterialController extends Controller
{
	const PER_PAGE = 15;

    const SOKYUKOKA_TEXT = '';

	/**
	 * Show Main & Search screen
	 * @param Request $req 
	 * @return type
	 */
    public function index(Request $req) {
        $search_by_list = [];
        $search_by_text = config('constant.material.search_by_text.default');
        $breadcrumb_text = config('constant.material.search_from.default');
        $this->tag_object = config('tags.material.default');
        session()->put(config('constant.session_key.material_last_search_url'), url()->full());

    	$material_list = M400Genryo::where('del_flg', config('constant.flg.no'))
            ->where('up_contents', config('constant.flg.yes'));
        
        // 訴求効果 search
        if (isset($req->s) && isset($req->t) && count($req->s) == count($req->t) && count($req->s) > 0) {
            $material_list = $material_list->whereHas('sokyu_categories', function ($q) use ($req) {
                $sokyu_cate_pair_conditions = array_map(function($sokyu_cate_cd, $sokyu_cate2){
                    return [$sokyu_cate_cd, $sokyu_cate2];
                }, $req->s, $req->t);
                $q->whereRaw('(' .
                        implode(',', ['`sokyu_cate_cd`', '`sokyu_cate2_cd`']) .
                    ') in (' . 
                        implode(', ', array_map(function ($e) {
                            return '('.implode(',', $e).')';
                        }, $sokyu_cate_pair_conditions)) .
                    ')'
                );
            });

            // add to search by list
            foreach ($req->t as $sokyu_cate2_id) {
                $sokyu_cate2_name = $this->get_name_from_master_list_by_id('', $sokyu_cate2_id, 2);
                if ($sokyu_cate2_name) {
                    $search_by_list[] = $sokyu_cate2_name;
                }
            }

            // adjust tag
            $tag_values = [
                '@sokyukoka' => implode(',', $search_by_list),
            ];
            $this->tag_object['title'] = strtr(config('tags.material.sokyukoka.title'), $tag_values);
            $this->tag_object['description'] = strtr(config('tags.material.sokyukoka.description'), $tag_values);
            $this->tag_object['keyword'] = strtr(config('tags.material.sokyukoka.keyword'), $tag_values);
            $breadcrumb_text = config('constant.material.search_from.sokyukoka');
        } elseif (isset($req->is_seikyu_search)) {
            // add an always false condition to remove all the results when search with no conditions
            $material_list->whereRaw('false');
        }


        // 訴求部位 search
        if (isset($req->sb) && count($req->sb) > 0) {
            $material_list = $material_list->whereRaw("CONCAT(',', `sokyu_bui`, ',') REGEXP ',(".implode('|', $req->sb)."),'");
            
            // add to search by list
            foreach ($req->sb as $sokyu_bui_cd) {
                $sokyu_bui_nm = $this->get_name_from_master_list_by_id('sokyu_bui_master_list', $sokyu_bui_cd);
                if ($sokyu_bui_nm) {
                    $search_by_list[] = $sokyu_bui_nm;
                }
            }

            // adjust tag
            $tag_values = [
                '@bui' => implode(',', $search_by_list),
            ];
            $this->tag_object['title'] = strtr(config('tags.material.bui.title'), $tag_values);
            $this->tag_object['description'] = strtr(config('tags.material.bui.description'), $tag_values);
            $this->tag_object['keyword'] = strtr(config('tags.material.bui.keyword'), $tag_values);
            $breadcrumb_text = config('constant.material.search_from.sokyubui');
        }
        // 成分名 search
        if (isset($req->sbi) && $req->sbi) {
            $material_list = $material_list->whereRaw('FIND_IN_SET(?, seibun_nm)', $req->sbi);

            // add to search by list
            $seibun_nm = $this->get_name_from_master_list_by_id('seibun_master_list', $req->sbi);
            if ($seibun_nm) {
                $search_by_list[] = $seibun_nm;
            }

            // adjust tag
            $tag_values = [
                '@seibunmei' => implode(',', $search_by_list),
            ];
            $this->tag_object['title'] = strtr(config('tags.material.seibunmei.title'), $tag_values);
            $this->tag_object['description'] = strtr(config('tags.material.seibunmei.description'), $tag_values);
            $this->tag_object['keyword'] = strtr(config('tags.material.seibunmei.keyword'), $tag_values);
            $breadcrumb_text = config('constant.material.search_from.seibunmei');
        }
        // 用途 search
        if (isset($req->st) && count($req->st) > 0) {
            $material_list = $material_list->whereRaw("CONCAT(',', `shokuten`, ',') REGEXP ',(".implode('|', $req->st)."),'");

            // add to search by list
            foreach ($req->st as $yoto_cate_cd) {
                $yoto_cate_nm = $this->get_name_from_master_list_by_id('shokuten_master_list', $yoto_cate_cd);
                if ($yoto_cate_nm) {
                    $search_by_list[] = $yoto_cate_nm;
                }
            }

            // adjust tag
            $tag_values = [
                '@yoto' => implode(',', $search_by_list),
            ];
            $this->tag_object['title'] = strtr(config('tags.material.yoto.title'), $tag_values);
            $this->tag_object['description'] = strtr(config('tags.material.yoto.description'), $tag_values);
            $this->tag_object['keyword'] = strtr(config('tags.material.yoto.keyword'), $tag_values);
            $breadcrumb_text = config('constant.material.search_from.yoto');
        }
        // 原料名, 規格成分 search
        if (isset($req->keyword) && $req->keyword) {
            $material_list = $material_list->where(function($q) use ($req) {
                $q->where('item_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('item_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('ippan_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('ippan_nm_kana', 'like', '%' . $req->keyword . '%')
                    ->orWhere('ippan_nm_kana', 'like', '%' . $req->keyword . '%')
                    // 企業名
                    ->orWhereIn('kigyo_cd', function($q) use ($req) {
                        $q->select('kigyo_cd')->from(with(new M200Company)->getTable())
                            ->where('kigyo_nm', 'like', '%' . $req->keyword . '%')
                            ->get();
                    })
                    // 機能性表示食品 ※ここは機能性表示というワードに引っ掛けたいです。
                    ->orWhere('sotei_hc', 'like', '%' . $req->keyword . '%')
                    ->orWhere('zaikei', 'like', '%' . $req->keyword . '%')
                    ->orWhere('kaigai', 'like', '%' . $req->keyword . '%')
                    ->orWhere('ninsho_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('seibun_nm', 'like', '%' . $req->keyword . '%')
                    ->orWhere('sokyu_koka', 'like', '%' . $req->keyword . '%')
                    ->orWhere('kanyo', 'like', '%' . $req->keyword . '%')
                    ->orWhere('kikaku', 'like', '%' . $req->keyword . '%')
                    ->orWhere('yoko_seibun_kana', 'like', '%' . $req->keyword . '%')
                    ->orWhere('seijo', 'like', '%' . $req->keyword . '%');
            });
            $breadcrumb_text = config('constant.material.search_from.keyword');
            $this->tag_object['description'] = config('tags.material.keywords.description');
        }
        // 原料, 海外に実績のある
        if (isset($req->k)) {
            $kaigai_michosa_cd = $this->get_id_from_master_list_by_name('kaigai_master_list', '未調査');
            $material_list = $material_list->whereNotNull('kaigai')->where('kaigai', 'not like', $kaigai_michosa_cd);
            $search_by_text = '海外に実績のある原料一覧';
        }
        // 原料, ペットに実績のある
        if (isset($req->p)) {
            $pet_shiyoka_cd = $this->get_id_from_master_list_by_name('pet_master_list', '使用可');
            $material_list = $material_list->whereRaw("CONCAT(',', `pet`, ',') REGEXP ',(".$pet_shiyoka_cd."),'");
            $search_by_text = 'ペットに実績のある原料一覧';
        }

        // Weird =,=!
        if (isset($req->keyword) && ($req->keyword == 'チハヤ' || $req->keyword == '龍泉堂')) {
            $material_list = $material_list->orderByRaw('-hyojijun DESC');
        }
        
        $material_list = $material_list->paginate(self::PER_PAGE);

        session()->put(config('constant.session_key.material_search_from_breadcrumb_text'), $breadcrumb_text);
    	session()->flashInput($req->input());
        if (count($search_by_list) > 0) {
            $search_by_text = implode('、', $search_by_list) . config('constant.material.search_by_text.suffix');
        }

    	return view(
    		'material.index', [
                'tag_object' => $this->tag_object,
                'material_list' => $material_list,
                'search_by_text' => $search_by_text,
                'breadcrumb_text' => $breadcrumb_text,
            ]
        );
    }

    /**
     * Show Material detail page
     * @param type|string $value 
     * @return type
     */
    public function get_detail(Request $req) {
        $material_last_search_url = session()->get(config('constant.session_key.material_last_search_url'), function() {
            return url('/material');
        });
        $search_from_breadcrumb_text = session()->get(config('constant.session_key.material_search_from_breadcrumb_text'), function() {
            return config('constant.material.search_from.default');
        });
        $this->tag_object = config('tags.material_detail.default');

        $material = M400Genryo::where('del_flg', config('constant.flg.no'))
            ->where('up_contents', config('constant.flg.yes'))
            ->find($req->genryo_id);
        $material_rec = null;

        if ($material) {
            $material_rec = M400Genryo::where('del_flg', config('constant.flg.no'))
                ->where('genryo_id', '!=', $req->genryo_id)
                ->where('kigyo_cd', $material->company->kigyo_cd)
                ->where('up_contents', config('constant.flg.yes'))
                ->where('rec_genryo', config('constant.flg.yes'))
                ->latest('crt_date')->take(20)->get();

            $material->hanbai_shutai_name = $this->get_name_from_master_list_by_id('hanbai_shutai_master_list', $material->hanbai_shutai);

            $sokyu_categories_tag_list = [];
            foreach ($material->sokyu_categories as $sokyu_category) {
                $sokyu_categories_tag_list[] = $sokyu_category->sokyu_cate->sokyu_cate_nm;
                if ($sokyu_category->sokyu_cate2) {
                    $sokyu_categories_tag_list[] = $sokyu_category->sokyu_cate2->sokyu_cate2_nm;
                }
                if ($sokyu_category->sokyu_cate3) {
                    $sokyu_categories_tag_list[] = $sokyu_category->sokyu_cate3->sokyu_cate3_nm;
                }
            }
            $tag_values = [
                '@ippan_nm' => $material->ippan_nm,
                '@seibun_nm' => implode(',', $material->seibun_nm),
                '@item_nm' => $material->item_nm,
                '@hanbai_kigyo_nm' => $material->company->kigyo_nm,
                '@sokyu_categories' => implode(',', $sokyu_categories_tag_list),
                '@sokyu_bui' => $this->get_data_list($material, 'sokyu_bui', 'sokyu_bui_master_list', 'sokyu_bui_cd', 'sokyu_bui_nm'),
                '@hitokoto' => $material->hitokoto,
                '@seijo' => $this->get_data_list($material, 'seijo', 'seijo_master_list', 'code', 'code_nm'),
            ];
            $this->tag_object['title'] = strtr(config('tags.material_detail.found.title'), $tag_values);
            $this->tag_object['description'] = strtr(config('tags.material_detail.found.description'), $tag_values);
            $this->tag_object['keyword'] = strtr(config('tags.material_detail.found.keyword'), $tag_values);
        }

        return view(
            'material.detail', [
                'tag_object' => $this->tag_object,
                'material' => $material,
                'recs' => $material_rec,
                'material_last_search_url' => $material_last_search_url,
                'search_from_breadcrumb_text' => $search_from_breadcrumb_text,
                'do_not_show_header_contact' => true,
            ]
        );
    }

    /**
     * Show Material toiawase page
     * @param type|string $value 
     * @return type
     */
    public function show_genryo_contact(Request $req) {
        $material = M400Genryo::where('del_flg', config('constant.flg.no'))
            ->find($req->mid);
        $contact = $req->contact;
        $contact_data = '';
        $title = 'お問い合わせ';
        switch ($contact) {
                case 'genryo_contact':
                    $contact_data = 'lf_url';
                    $title = '原料のお問い合わせ';
                    break;
                case 'dl_contact':
                    $contact_data = 'lf_url_dl';
                    $title = '資料ダウンロード';
                    break;
                case 'sample_contact':
                    $contact_data = 'lf_url_sample';
                    $title = '無償サンプル依頼';
                    break;
                case 'genryo_video_key_request':
                    $contact_data = 'video_get_password_url';
                    $title = '原料動画パスワード申請';
                    break;
            }

        return view(
            'material.genryo_contact', [
                'material' => $material,
                'contact' => $contact_data,
                'title' => $title,
            ]
        );
    }
    private function get_data_list($object, $name, $master_obj_list_name, $master_key, $master_value, $delimiter = ',') {
        $master_obj_list = view()->shared($master_obj_list_name);
        return implode($delimiter, 
            array_map(function($object_cd) use ($master_obj_list, $master_key, $master_value) {
                foreach ($master_obj_list as $master_obj) {
                    if ($master_obj->{$master_key} == $object_cd) {
                        return $master_obj->{$master_value};
                    }
                }
                return '';
            }, $object->{$name})
        );
    }
}
