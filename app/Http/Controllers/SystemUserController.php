<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SystemUserController extends Controller
{
    //middleware
//    public function __construct()
//    {
//        $this->middleware('auth:system_admin');
//    }

    public function create(){
        return view('system_user.new');
    }

    public function store(Request $request){
      $this->validate($request,[
          'name'=>'required',
          'staff_code'=>'required',
          'email'=>'required|email|unique:users,email',
          'user_type'=>'required',
          'rights_body'=>'required',
          'mobile'=>'required',
          'designation'=>'required',
          'address'=>'required',
          'department'=>'required',
          'description'=>'required',
          'password'=>'required|string|confirmed|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
          'role'=>'required'
      ]);
        //Store the data into the database
        $user=new User();
        $user->name=$request->name;
        $user->staff_code=$request->staff_code;
        $user->email=$request->email;
        $user->user_type=$request->user_type;
        $user->rights_body=$request->rights_body;
        $user->mobile=$request->mobile;
        $user->designation=$request->designation;
        $user->address=$request->address;
        $user->department=$request->department;
        $user->description=$request->description;
        $user->password=Hash::make($request->password);
//        $user->active=1;
        $user->role=$request->role;
        $user->save();
        return redirect()->back()->with('success', 'User role added successfully');
    }

    public function index() {
        $users=User::orderBy('id','DESC')
            ->whereNotIn('role',['stakeholder'])
            ->get();
        return view('system_user.all_user_list')->with('users',$users);
    }

    public function edit($id){
        $user=User::find($id);
        return view('system_user.edit_system_user')->with('user',$user);
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
            'staff_code'=>'required',
            'email'=>'required|email|unique:users,email',
            'user_type'=>'required',
            'rights_body'=>'required',
            'mobile'=>'required',
            'designation'=>'required',
            'address'=>'required',
            'department'=>'required',
            'description'=>'required',
            'role'=>'required'
        ]);
        //Store the data into the database
        $user=User::find($id);
        $user->name=$request->name;
        $user->staff_code=$request->staff_code;
        $user->email=$request->email;
        $user->user_type=$request->user_type;
        $user->rights_body=$request->rights_body;
        $user->mobile=$request->mobile;
        $user->designation=$request->designation;
        $user->address=$request->address;
        $user->department=$request->department;
        $user->description=$request->description;
//        $user->active=1;
        $user->role=$request->role;
        $user->save();
        return redirect()->back()->with('success', 'User Role Updated Successfully');
    }

    public function destroy(Request $request){
        $user=User::findOrFail($request->id);
        //dd($user);
        if ($user && $user->role =='stakeholder'){
            $user->delete();
            return response()->json('success',201);
        }else{
            return response()->json('error',422);
        }
    }
}
