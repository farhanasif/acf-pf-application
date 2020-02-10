<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Auth;
use DB;
class UserController extends Controller
{
    public function showLoginForm()
    {
     return view('login');
    }

    public  function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|min:3'
     ]);

     $user_data = array(
      'email'  => $request->get('email'),
      'password' => $request->get('password')
     );

     if(Auth::attempt($user_data))
     {
      return redirect('/');
     }
     else
     {
      return back()->with('error', 'Wrong Login Details');
     }
   }

    public function logout()
    {
     Auth::logout();
     return redirect('login');
    }

    public function show_add_user()
    {
     return view('user.add_user');
    }

    public function store_add_user(Request $request)
    {
      $request->validate([
         'name' => 'required',
         'staff_code' => 'required',
         'email' => 'required',
         'role' => 'required',
         'rights_body' => 'required',
         'mobile' => 'required',
         'designation' => 'required',
         'address' => 'required',
         'department' => 'required',
         'description' => 'required',
         'password' => 'required',
         'verified' => 'required',
         'user_type' => 'required',
     ]);;

      $users = new User;
      $users->name = $request->name;
      $users->staff_code = $request->staff_code;
      $users->email = $request->email;
      $users->role = $request->role;
      $users->rights_body = $request->rights_body;
      $users->mobile = $request->mobile;
      $users->designation = $request->designation;
      $users->address = $request->address;
      $users->department = $request->department;
      $users->description = $request->description;
      $users->password =  Hash::make($request->password);
      $users->verified = $request->verified;
      $users->user_type = $request->user_type;
      $users->save();
     return redirect('/add-user')->with('success','User Information Sucesfully Added!');
    }

     public function user_batch_upload(Request $request)
     {

       // $this->validate($request,[
       //   'file' => 'required|mimes:csv,xls,xlsx'
       // ]);

           	if ($request->hasFile('file'))
           	{
                   // $fileName = time().'.'.$request->file->extension();
                   // $fileData  = $request->file->move(public_path('uploads/user'), $fileName);
           	    $array = Excel::toArray(new UsersImport, request()->file('file'));
           	     dd($array);
                  exit();
           	 }
      return view('user.user_batch_upload');
     }


    public function all_user()
    {
       $users = User::all();
       return view('user.all_user',compact('users'));
    }

    public function edit_user($id)
    {
       return view('user.edit_user',compact('id'));
    }

    public function update_user(Request $request, $id)
    {
      $request->validate([
         'name' => 'required',
         'staff_code' => 'required',
         'email' => 'required',
         'role' => 'required',
         'rights_body' => 'required',
         'mobile' => 'required',
         'designation' => 'required',
         'address' => 'required',
         'department' => 'required',
         'description' => 'required',
         'password' => 'required',
         'verified' => 'required',
         'user_type' => 'required',
     ]);;
        $id->update($request->all());

        return redirect()->back()
                        ->with('success','User updated successfully');
    }

    public function delete_user($id)
    {
    $users = User::where('id',$id)->first();
    $users->delete();
    return redirect()->back();
    }

    public function import(Request $request)
    {
		$this->validate($request,[
			'file'  =>'required'
		]);
    	if ($request->hasFile('file'))
    	{
            // $fileName = time().'.'.$request->file->extension();
            // $fileData  = $request->file->move(public_path('uploads'), $fileName);
    	    $array = Excel::toArray(new UsersImport, request()->file('file'));
    	   // dd($array);
        //    exit();
        //    for($i = 0; $i < count($array); $i++) {

        //        $users = new User;
        //        $users->name = $array->name;
        //        echo $users->name;
        //        exit();

        //        }
    	 }


    }

    public function addUser()
    {

    }

}
