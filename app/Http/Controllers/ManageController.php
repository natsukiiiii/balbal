<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \Auth;

use App\Models\M470Seibun;
use App\Models\M400Genryo;

class ManageController extends Controller
{
	protected $redirectTo = '/manage/login';

    public function index(Request $req) {
    	return view('manage.index');
    }

    /**
     * Show the login screen
     * @param Request $req 
     * @return type
     */
    public function get_login(Request $req) {
    	return view('manage.login');
    }
    
    /**
     * Check the input user_data then log he/she in if the check was passed
     * (The password was hashed by Laravel (Bcrypt) as deafaut.
     * To check it. Do: \Illuminate\Support\Facades\Hash::make('raw password here');
     * Redirect to /manage if logged in
     * @param Request $req 
     * @return type
     */
    public function post_login(Request $req) {
    	if (Auth::check()) {
    		// Currently logged in
    		return \Redirect::to('/manage/');
    	}

    	$userdata = [
        	'user_id' => $req->get('user_id'),
        	'password' => $req->get('password'),
    	];

	    if (Auth::attempt($userdata)) {
	        // validation successful!
	        return \Redirect::to('/manage/');
	    } else {        
	        // validation not successful, send back to form
	        return back()->withInput()->with('error', 'ログインIDまたはパスワードが正しくありません。');
	    }
    }

	/**
	 * Logout user then redirect user to login screen
	 * @param Request $req 
	 * @return type
	 */
    public function get_logout(Request $req) {
    	if (Auth::check()) {
    		Auth::logout();
    	}
		return \Redirect::to('/manage/login');
    }

    /**
     * Manually clear the Laravel cache
     * @param type|string $value 
     * @return type
     */
    public function clear_cache(Request $req) {
        \Cache::flush();
        return view(
            'manage.index',
            ['msg' => 'Clear Cache DONE!']
        );
    }

    /**
     * Pre-build the result count for each seibunmei type, write to biko field
     * @param Request $req 
     * @return void
     */
    public function build_material_seibunmei_counter(Request $req) {
        echo 'Start: build_material_seibunmei_counter<br>';
        $seibun_list = M470Seibun::all();
        foreach ($seibun_list as $seibun) {
            $number_of_result = M400Genryo::where('del_flg', config('constant.flg.no'))
                ->where('up_contents', config('constant.flg.yes'))
                ->whereRaw('FIND_IN_SET(?, seibun_nm)', $seibun->seibun_cd)
                ->count();
            $seibun->biko = $number_of_result;
            $seibun->save();
            echo "Done > seibun_cd: {$seibun->seibun_cd} - Count: {$number_of_result}<br>";
            flush();
        }
        echo '========================<br>Finish successfully!';
    }
}
