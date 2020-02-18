<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\EmployeesImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Auth;
use DB;

class EmployeeController extends Controller
{
    public function add_employee()
    {
      return view('employee.add_employee');
    }

    public function all_employee()
    {
      $employees = DB::table('employees')->get();
      return view('employee.all_employee',compact('employees'));
    }

    public function employee_batch_upload()
    {
      return view('employee.employee_batch_upload');
    }

    public function save_employee_batch_upload(Request $request)
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
        $result = Excel::toArray(new EmployeesImport, $upload);

        // dd($result );
        // exit;
        foreach ($result as $key => $value) {
          foreach ($value as $row) {
  
                  $insert_data[] =array(
                  'staff_code' =>$row[0],
                  'trimmed' =>$row[0],
                  'first_name' =>$row[1],
                  'last_name' =>$row[2],
                  'position' =>$row[3],
                  // 'department_code' =>NULL,
                  'category' =>$row[4],
                  'level' =>$row[5],
                  'base' =>$row[6],
                  'work_place' =>$row[10],
                  // 'sub_location' =>NULL,
                  'basic_salary' =>$row[12],
                  'gross_salary' =>$row[13],
                  'pf_amount' =>$row[16],
                  // 'pf_percentage' =>$NULL,
                  // 'joining_date' =>$row[7],
                  // 'ending_date' =>$row[9],
                  'status' =>1,
                  'created_by' =>Auth::user()->id,
                  'updated_by' =>Auth::user()->id,
              );
          }
      }

        // dd($insert_data);
        // exit;

      if (!empty($insert_data)) {
          DB::table('employees')->insert($insert_data);
          return back()->with('success','Employees batch import successfully');
      }
      else{
        return back()->with('error','Not Insert');
      }

        
      }
  
    

    }

    public function save_employee(Request $request)
    {
       // $employees = new Employee;
       // $employees->staff_code = $request->staff_code;
       // $employees->trimmed = $request->staff_code;
       // $employees->first_name = $request->first_name;
       // $employees->last_name = $request->last_name;
       // $employees->position = $request->position;
       // $employees->department_code = $request->department_code;
       // $employees->category = $request->category;
       // $employees->level = $request->level;
       // $employees->base = $request->base;
       // $employees->work_place = $request->work_place;
       // $employees->sub_location = $request->sub_location;
       // $employees->basic_salary = $request->basic_salary;
       // $employees->gross_salary = $request->gross_salary;
       // $employees->pf_amount = $request->pf_amount;
       // $employees->pf_percentage = 10;
       // $employees->joining_date = $request->joining_date;
       // $employees->ending_date = $request->ending_date;
       // $employees->status = 1;
       // $employees->created_by = Auth::user()->id;
       // $employees->updated_by = Auth::user()->id;
       // $employees->save();
       // return back();
       $data = array();
       $data['staff_code'] = $request->staff_code;
       $data['first_name'] = $request->first_name;
       $data['last_name'] = $request->last_name;
       $data['position'] = $request->position;
       $data['department_code'] = $request->department_code;
       $data['category'] = $request->category;
       $data['level'] = $request->level;
       $data['base'] = $request->base;
       $data['work_place'] = $request->work_place;
       $data['sub_location'] = $request->sub_location;
       $data['basic_salary'] = $request->basic_salary;
       $data['gross_salary'] = $request->gross_salary;
       $data['pf_amount'] = $request->pf_amount;
       $data['joining_date'] = $request->joining_date;
       $data['ending_date'] = $request->ending_date;
       $data['created_by'] = Auth::user()->id;
       $data['updated_by'] =  Auth::user()->id;
       $provident_fund = DB::table('employees')->insert($data);
       return back()->with('success', 'Employees Added Successfully.');
    }

    public function edit_employee($id)
    {
      $employee = DB::table('employees')->where('id',$id)->first();
      return view('employee.edit_employee',compact('employee'));
    }
    public function update_employee(Request $request, $id)
    {
      $data = array();
      $data['staff_code'] = $request->staff_code;
      $data['first_name'] = $request->first_name;
      $data['last_name'] = $request->last_name;
      $data['position'] = $request->position;
      $data['department_code'] = $request->department_code;
      $data['category'] = $request->category;
      $data['level'] = $request->level;
      $data['base'] = $request->base;
      $data['work_place'] = $request->work_place;
      $data['sub_location'] = $request->sub_location;
      $data['basic_salary'] = $request->basic_salary;
      $data['gross_salary'] = $request->gross_salary;
      $data['pf_amount'] = $request->pf_amount;
      $data['joining_date'] = $request->joining_date;
      $data['ending_date'] = $request->ending_date;
      $data['created_by'] = Auth::user()->id;
      $data['updated_by'] =  Auth::user()->id;

      DB::table('employees')->where('id',$id)->update($data);
      return back()->with('success', 'Employee Updated Successfully.');
    }

    public function delete_employee($id)
    {
      DB::table('employees')->where('id',$id)->delete();
      return redirect()->back();
    }
}
