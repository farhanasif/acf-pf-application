<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        // $url = $request->path(); //roleman
        // $get_user_role = 2; //get user role from auth info, mostly from users table
        // $someval = \RoleHelper::checkPermission($url, $get_user_role);
        // if($someval != 'grant'){
        //     Route::redirect('/admin-home');
        // }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function roleman(Request $request)
    {
        $url = $request->path(); //roleman
        $get_user_role = 2; //get user role from auth info, mostly from users table
        $someval = \RoleHelper::checkPermission($url, $get_user_role);
        return $someval;
    }
}
