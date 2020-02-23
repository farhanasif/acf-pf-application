<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Auth;

class AdminController extends Controller
{
  

    public function admin_home(){

    	return view('admin_home');
    }

    public function user_home(){

    	return view('user_home');
    }

    public function department()
    {
        return view('master_data.department');
    }

    public function save_department(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'department_code' => 'required',
        ]);

        $department = new Department;
        $department->name = $request->name;
        $department->department_code = $request->department_code;
        $department->created_by = Auth::user()->id;
        $department->updated_by = Auth::user()->id;
        $department->save(); 
        return redirect()->back()->with('success','Department Added Successfully!');
    }
    
    // public function all_department()
    // {   
    //     $departments = Department::all();
    //     return view('department.all_department',compact('departments'));
    // }

    public function edit_department($id)
    {
        $department = Department::find($id);
         return view('department.edit_department', compact('department'));
    }

    public function update_department(Request $request, $id)
    {
        $department = Department::find($id);
        $department->name = $request->name;
        $department->department_code = $request->department_code;
        $department->save(); 
        return redirect()->back()->with('success','Department Updated Successfully!');

    }

    public function delete_department($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->back();
    }

    
}
