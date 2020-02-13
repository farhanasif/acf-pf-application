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
     ]);

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
     return redirect('/add-user')->with('success','User information successfully added!');
    }

    public function show_batch_upload()
    {
      return view('user.user_batch_upload');
    }

     public function save_user_batch_upload(Request $request)
     {
       $upload = $request->file('file');
        $filename = $_FILES['file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        echo $filename;
        exit;
        $accept_files = ["csv", "txt", "xlsx"];
        if(!in_array($ext, $accept_files)) {
            // return redirect()->route('upload_pop_db')
            // ->with('flash_msg', 'Invalid file extension. permitted file is .csv, .txt & .xlsx');
            echo 'no file';
          //  return back();
        }
        // get the file
        $upload = $request->file('file');
        $filePath = $upload->getRealPath();
        // echo $filePath;
        // exit;
        if($ext == "xlsx" || $ext == "csv") {
            // $result = Excel::toArray($filePath, function($reader) {
            //     $reader->all();
            // })->get();

        $result = Excel::toArray($filePath,function($reader){
        $reader->all();
    })->get();
            foreach($result as $key => $val) {
                $users = new User;
                $users->name = $val->name;
                $users->staff_code = $val->staff_code;
                $users->email = $val->email;
                $users->role = $val->role;
                $users->rights_body = $val->rights_body;
                $users->mobile = $val->mobile;
                $users->designation = $val->designation;
                $users->address = $val->address;
                $users->department = $val->department;
                $users->description = $val->description;
                $users->password =  Hash::make($val->password);
                $users->verified = $val->verified;
                $users->user_type = $val->user_type;
                $users->save();
            }
            // return redirect('manage-sw-name')->with('flash_msg', 'POP db inserted successfully');
            echo 'not insert';
          //  return back();
        }

    // return view('customer.switch.upload_pop_db');

       // $this->validate($request,[
       //   'file' => 'required|mimes:csv,xls,xlsx'
       // ]);

           	// if ($request->hasFile('file'))
           	// {
            //        // $fileName = time().'.'.$request->file->extension();
            //        // $fileData  = $request->file->move(public_path('uploads/user'), $fileName);
           	//     // $array = Excel::toArray(new UsersImport, request()->file('file'));
            //     $array = Excel::import(new UsersImport, request()->file('file'));
            //     // foreach($array->toArray() as $key => $value)
            //     //       {
            //     //        foreach($value as $row)
            //     //        {
            //     //         $insert_data[] = array(
            //     //          'name'  => $row['name'],
            //     //          'staff_code'   => $row['staff_code'],
            //     //          'email'   => $row['email'],
            //     //          'role'    => $row['role'],
            //     //          'mobile'  => $row['mobile'],
            //     //          'designation'   => $row['designation'],
            //     //          'address'  => isset($row['address'])?$row['address']:'',
            //     //          'password'   => $row['password'],
            //     //          'user_type'   => $row['user_type']
            //     //         );
            //     //        }
            //     //       }
            //     //  if(!empty($insert_data))
            //     //   {
            //     //    DB::table('users')->insert($insert_data);
            //     //   }
           	//  }

     }

    public function all_user()
    {
       $users = User::all();
       return view('user.all_user',compact('users'));
    }

    public function edit_user($id)
    {
      $users = User::find($id);
       return view('user.edit_user',compact('users'));
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
         'verified' => 'required',
         'user_type' => 'required',
     ]);
        $users = User::find($id);
        $users->update($request->all());
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
