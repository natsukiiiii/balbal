<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use A
use App\Http\Controllers\ManageCompanyController;

class ManageCompanyTest extends TestCase
{
    /**
     * Test the __contruct() function in class
     * @return void
     */
    public function testConstructor()
    {
    	$controller = new ManageCompanyController;
        $this->assertInstanceOf(ManageCompanyController::class, $controller);
    }

   	/**
   	 * User have to login, got authenticated before using this controller
   	 * @dataProvider providerRedirectToLoginPageWhenUnauthentited
   	 * @param string $uri 
   	 * @param int $expected_status_code 
   	 * @param string $expected_redirect_uri 
   	 * @return void
   	 */
    public function testRedirectToLoginPageWhenUnauthentited($uri, $expected_status_code, $expected_redirect_uri)
    {
    	$response = $this->get($uri);
        $response->assertStatus($expected_status_code);
        $response->assertRedirect($expected_redirect_uri);
    }

   	/**
   	 * Provide the test cases for testRedirectToLoginPageWhenUnauthentited
   	 * @return void
   	 */
    public function providerRedirectToLoginPageWhenUnauthentited()
    {
    	return [
    		[ '/manage/company/'			, 302, '/manage/login'],
    		[ '/manage/company/abcdef'		, 302, '/manage/login'],
    		[ '/manage/company/store'		, 302, '/manage/login'],
    		[ '/manage/company/create'		, 302, '/manage/login'],
    		[ '/manage/company/edit'		, 302, '/manage/login'],
    		[ '/manage/company/do_insert'	, 302, '/manage/login'],
    		[ '/manage/company/do_update'	, 302, '/manage/login'],
    	];
    }


    public function FunctionName()
    {
    	$user = factory(User::class)->create();
    }

    /**
     * Logedin User can use this controller
     * @return type
     */
    public function providerAuthentitedUserUseController()
    {

    }
}
