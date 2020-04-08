<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ChangeProfileController extends Controller
{
    public function edit_change_profile($id)
    {
        $profile = User::where('id',$id)->first();
        return view('change_profile',compact('profile')); 
    }
}
