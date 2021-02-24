<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated($request, $user){

        // if(Auth::user()->role =='0'){
        //     return redirect()->intended('/admin-home');
        // }
        // elseif (Auth::user()->role =='1') {
        //     // dd('user');
        //     return redirect()->intended('/user-home');

        // }

        if(Auth::user()->role =='stakeholder'){
            return redirect()->intended('/admin-home');
        }elseif (Auth::user()->role =='master-admin'){
            return redirect()->intended('/admin-home');
        }elseif (Auth::user()->role =='sub-admin'){
            return redirect()->intended('/admin-home');
        }elseif (Auth::user()->role =='editor'){
            return redirect()->intended('/admin-home');
        }elseif (Auth::user()->role =='modaretor'){
            return redirect()->intended('/admin-home');
        }
        elseif (Auth::user()->role =='1') {
            return redirect()->intended('/user_home');

        }else{
            return redirect('/login');
        }


    }
}
