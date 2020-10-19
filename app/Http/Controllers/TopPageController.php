<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Auth;

use App\Models\M400Genryo;
use App\Models\M300Kinosei;

class TopPageController extends Controller
{
	/**
	 * Get the top page view
	 * @param Request $req 
	 * @return view
	 */
    public function index(Request $req) {
        $material_list = M400Genryo::where('del_flg', config('constant.flg.no'))
            ->where('up_contents', config('constant.flg.yes'))
            ->where('top_random', config('constant.flg.yes'))
            ->inRandomOrder()->limit(9)->get();

        $function_list = M300Kinosei::where('del_flg', config('constant.flg.no'))
            ->where('up_contents', config('constant.flg.yes'))
            ->orderByRaw('kinosei_cd DESC')->limit(12)->get();


    	return view(
    		'index', 
            [
                'tag_object' => $this->tag_object,
                'material_list' => $material_list,
                'function_list' => $function_list,

            ]
            
        );

    }

    /**
     * Get the contact view
     * @param Request $req 
     * @return view
     */
    public function get_contact(Request $req) {
        $this->tag_object = config('tags.top.contact');
    	return view(
    		'contact', 
    		['tag_object' => $this->tag_object]
    	);
    }

    /**
     * Get the static company page
     * @param Request $req 
     * @return view
     */
    public function get_company(Request $req) {
        $this->tag_object = config('tags.top.company');
        return view(
            'company',
            ['tag_object' => $this->tag_object]
        );
    }
    /**
     * Get the static sitemap page
     * @param Request $req 
     * @return view
     */
    public function get_sitemap(Request $req) {
        $this->tag_object = config('tags.top.sitemap');
        return view(
            'sitemap',
            ['tag_object' => $this->tag_object]
        );
    }
    /**
     * Get the static privacypolicy page
     * @param Request $req 
     * @return view
     */
    public function get_privacypolicy(Request $req) {
        $this->tag_object = config('tags.top.privacypolicy');
        return view(
            'privacypolicy',
            ['tag_object' => $this->tag_object]
        );
    }
    /**
     * Get the static terms page
     * @param Request $req 
     * @return view
     */
    public function get_terms(Request $req) {
        $this->tag_object = config('tags.top.terms');
        return view(
            'terms',
            ['tag_object' => $this->tag_object]
        );
    }
}
