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


    public function update_passsword(Request $request, $id)
    {
        // $request->validate([
        //     'current_password' => ['required', new MatchOldPassword],
        //     'new_password' => ['required'],
        //     'new_confirm_password' => ['same:new_password'],
        // ]);

        // User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        // dd('Password change successfully.');

    }
}
