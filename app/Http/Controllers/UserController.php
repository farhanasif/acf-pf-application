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
        //  'name' => 'required',
        //  'staff_code' => 'required',
        //  'email' => 'required',
        //  'role' => 'required',
        //  'rights_body' => 'required',
        //  'mobile' => 'required',
        //  'designation' => 'required',
        //  'address' => 'required',
        //  'department' => 'required',
        //  'description' => 'required',
        // //  'password' => 'required',
        //  'verified' => 'required',
        //  'user_type' => 'required',
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
      // $users->password =  Hash::make($request->password);
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
        $accept_files = ["csv", "txt", "xlsx"];
        if(!in_array($ext, $accept_files)) {
            return redirect()->back()
            ->with('error', 'Invalid file extension. permitted file is .csv, .txt & .xlsx');
        }
        // get the file
        $upload = $request->file('file');
        $filePath = $upload->getRealPath();

        if($ext == "xlsx" || $ext == "csv") {
        $result = Excel::import(new UsersImport, $upload);
        

   //  foreach ($result as $key => $value) {
   //      array_shipt($value);
   //      foreach ($value as $row) {

   //              $insert_data[] =array(
   //              'name' =>$row[1],
   //              'staff_code' =>$row[2],
   //              'email' =>$row[3],
   //              'role' =>$row[4],
   //              'rights_body' =>$row[5],
   //              'mobile' =>$row[6],
   //              'designation' =>$row[7],
   //              'address' =>$row[8],
   //              'department' =>$row[9],
   //              'description' =>$row[10],
   //              'password' =>$row[11],
   //              'verified' =>$row[12],
   //              // 'user_type' =>$row[13],
   //          );

   //  //      // $users = new User;
   // //   //            $users->name = $val[0];
   // //   //            $users->staff_code = $val[1];
   // //   //            $users->email = $val[2];
   // //   //            $users->role = $val[3];
   // //   //            $users->rights_body = $val[4];
   // //   //            $users->mobile = $val[5];
   // //   //            $users->designation = $val[6];
   // //   //            $users->address = $val[7];
   // //   //            $users->department = $val[8];
   // //   //            $users->description = $val[9];
   // //   //            $users->password =  $val[10];
   // //   //            $users->verified = $val[11];
   // //   //            $users->user_type = $val[12];
   // //   //            $users->save();
   //      }
   //  }

  // dd($insert_data);
  // exit;

    // if (!empty($insert_data)) {
    //     DB::table('users')->insert($insert_data);
    // }
  }
  
    return back()->with('success','User batch import successfully');

    // }
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
