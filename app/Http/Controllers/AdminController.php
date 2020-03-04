<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Auth;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function admin_home(){

    	return view('admin_home');
    }

    public function user_home(){

    	return view('user_home');
    }
}
