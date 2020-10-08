<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //Assign permission method
    public function assign(){
        $user=User::orderBy('id','DESC')
            ->whereNotIn('role',['stakeholder'])
            ->get();

        $permission=Permission::orderBy('name','ASC')->get();
        // dd($permission);
        return view('permission.assign_permission')
            ->with('users',$user)
            ->with('permissions',$permission);
    }

    public function assignPermission(Request $request){
        $this->validate($request,[
            'user_id'=>'required',
            'permissions'=>'required|array|min:1'
        ]);

        $user=User::find($request->user_id);
        //dd($user);
        $user->permissions()->attach($request->permissions);
        return redirect()->back()->with('success', 'Successfully Role Assigned');
    }

    //Update permission method
    public function updatePermission(Request $request){
        $this->validate($request,[
            'show_edit_id'=>'required',
            'edit_permissions'=>'required|array|min:1'
        ]);

        $user=User::find($request->show_edit_id);
        //sync always array akare data pass kre---oi je multiple permission==edit_permissions[]
        $user->permissions()->sync($request->edit_permissions);

        return redirect()->back()->with('success', 'You Have Successfully Updated The Permission');
    }

    //Delete permission method
    public function deletePermission($id){
        $user=User::find(id);
        $user->permissions()->detach();
        return response()->json('success',201);
    }
}
