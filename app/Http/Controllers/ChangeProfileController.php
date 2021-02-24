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

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $oldHashPassword = Auth::user()->password;

        if (\Hash::check($request->old_password, $oldHashPassword)) {
            $user = User::find(Auth::id());
            $user->password = \Hash::make($request->password);
            $user->save();

            return back()->with('success','Password change successfully!..');
        }
    }
}
