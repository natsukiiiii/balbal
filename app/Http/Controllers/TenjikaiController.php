<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TenjikaiController extends Controller
{
    const INTERNATIONAL_AREA_LIST = ['中国', 'アジア', '中東', '欧州', '北米', '南米'];
    const PER_PAGE = 20;

    public function index(Request $req) {
        $this->tag_object = config('tags.tenjikai.default');
        $page = ($req->page) ? $req->page : 1;

        $query = new \WP_Query([
            'post_type' => 'tenjikai',
            'order' => 'DESC',
            'orderby' => 'post_date',
        ]);
        $posts = $query->get_posts();
        
        // make $post can be paginated by Laravel
        $posts = new LengthAwarePaginator(
            collect($posts)->forPage($page, self::PER_PAGE),
            count($posts),
            self::PER_PAGE,
            $page,
            array('path' => $req->url())
        );

        // add meta data to $post
        $posts->getCollection()->transform(function ($post) {
            $post->meta = get_post_meta($post->ID, false, true);
            $post->meta = array_map(function($meta) {
                return (is_array($meta) && count($meta) == 1) ? $meta[0] : $meta;
            }, $post->meta);

            $post->is_kaigai = isset($post->meta['area']) && in_array($post->meta['area'], self::INTERNATIONAL_AREA_LIST) ? true : false;

            $post->thumbnail_url = get_the_post_thumbnail_url($post->ID);

            return $post;
        });

    	return view('tenjikai.index', [
            'tag_object' => $this->tag_object,
            'posts' => $posts,
        ]);
    }
}