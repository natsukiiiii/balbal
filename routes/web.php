<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Guest routes
 */
Route::group(['middleware' => ['web']], function() {
	// Route::get('/', function() {
	// 	return File::get(public_path() . '/index.html');
	// });
	Route::get('/'						, ['uses' => 'TopPageController@index']);
	Route::get('/contact'				, ['uses' => 'TopPageController@get_contact']);	

	Route::get('/company'				, ['uses' => 'TopPageController@get_company']);	
	Route::get('/sitemap'				, ['uses' => 'TopPageController@get_sitemap']);	
	Route::get('/privacypolicy'		    , ['uses' => 'TopPageController@get_privacypolicy']);	
	Route::get('/terms'				    , ['uses' => 'TopPageController@get_terms']);		
	
	Route::get('/search/{type}/{seibun_mei}', ['uses' => 'SearchController@index'])
		->where('type', '(material|benchmark)')
		->where('seibun_mei', '[あかさたなはまやらわ]');

	Route::get('/material'				, ['uses' => 'MaterialController@index']);
	Route::get('/material/detail/{genryo_id}'		, ['uses' => 'MaterialController@get_detail']);
	Route::get('/material/{contact}'	, ['uses' => 'MaterialController@show_genryo_contact'])->where('contact', '^(genryo_contact|dl_contact|sample_contact|genryo_video_key_request)$');
	Route::get('/food'					, ['uses' => 'FoodController@index']);
	Route::get('/food/detail/{kinosei_cd}', ['uses' => 'FoodController@get_detail'])->where('kinosei_cd', '[0-9]+');

	Route::get('/benchmark'				, ['uses' => 'BenchmarkController@index']);
	Route::get('/benchmark/detail/{benchmark_cd}', ['uses' => 'BenchmarkController@get_detail']);
	Route::get('/benchmark/compare'		, ['uses' => 'BenchmarkController@get_compare']);

	Route::get('/tenjikai'				, ['uses' => 'TenjikaiController@index']);

	// for Ajax
	Route::get('/getSokyuCate2/{sokyu_cate_cd}', ['uses' => 'AjaxController@get_sokyu_category_2'])->where('sokyu_cate_cd', '[0-9]+');
	Route::get('/getSokyuCate3/{sokyu_cate2_cd}', ['uses' => 'AjaxController@get_sokyu_category_3'])->where('sokyu_cate2_cd', '[0-9]+');
});

Route::group(['middleware' => ['quick_basic_auth']], function() {
	Route::get('/manage/login'			, ['uses' => 'ManageController@get_login']);
	Route::post('/manage/login'			, ['uses' => 'ManageController@post_login']);
});

/**
 * Authentication Required routes
 */
Route::group(['middleware' => ['auth']], function() {
	Route::get('/manage'				, ['uses' => 'ManageController@index']);
	Route::get('/manage/logout'			, ['uses' => 'ManageController@get_logout']);

	Route::resources([
	    '/manage/company' 			=> 'ManageCompanyController',
	    '/manage/functionality'		=> 'ManageFunctionalityController',
	    '/manage/material' 			=> 'ManageMaterialController',
	    '/manage/benchmark' 		=> 'ManageBenchmarkController',
	]);

	// hidden routes
	Route::get('/manage/clearcache'		, ['uses' => 'ManageController@clear_cache']);
	Route::get('/manage/build/material/seibunmei_counter' , ['uses' => 'ManageController@build_material_seibunmei_counter']);
});