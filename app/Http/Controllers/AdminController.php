<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  

    public function admin_home(){

    	return view('admin_home');
    }

    public function user_home(){

    	return view('user_home');
    }

    
}
