<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\EmployeesImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Auth;
use DB;
use App\Level;
use App\Position;
use App\Category;
use App\Base;
use App\Sub_location;
use App\Work_place;
use App\Department;
use App\Employee;

class EmployeeController extends Controller
{

 
    public function add_employee()
    {
        // $data = array();
        $levels = Level::all();
        $positions = Position::all();
        $categories = Category::all();
        $bases = Base::all();
        $sub_locations = Sub_location::all();
        $work_places = Work_place::all();
        $departments = DB::table('departments')->get();
        // print_r($data);
        // exit;

        return view('employee.add_employee',compact('departments','work_places','levels','positions','categories','bases','sub_locations'));
    }

    public function all_employee()
    {
      // $employees = DB::table('employees')->get();
      $employees = Employee::all();
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
            
            // $result = DB::table('employees')->where('staff_code',$row[0])->first();
            //   if(!empty($result))
            //   {
            //     $update_data[] =array(
            //       // 'staff_code' =>$row[0],
            //       // 'trimmed' =>$row[0],
            //       'first_name' =>$row[1],
            //       'last_name' =>$row[2],
            //       'position' =>$row[3],
            //       // 'department_code' =>NULL,
            //       'category' =>$row[4],
            //       'level' =>$row[5],
            //       'joining_date' =>date($row[7]),
            //       // 'ending_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]),
            //       'ending_date' =>date($row[9]),
            //       'base' =>$row[10],
            //       'work_place' =>$row[10],
            //       // 'sub_location' =>NULL,
            //       'basic_salary' =>$row[12],
            //       'gross_salary' =>$row[13],
            //       'pf_amount' =>$row[16],
            //       // 'pf_percentage' =>$NULL,
            //       'status' =>1,
            //       'created_by' =>Auth::user()->id,
            //       'updated_by' =>Auth::user()->id,
            //       );
            //   }
            //   else{
                $insert_data[] =array(
                  // 'staff_code' =>$row[0],
                  // 'trimmed' =>$row[0],
                  'first_name' =>$row[1],
                  'last_name' =>$row[2],
                  'position' =>$row[3],
                  // 'department_code' =>NULL,
                  'category' =>$row[4],
                  'level' =>$row[5],
                  'joining_date' =>date($row[7]),
                  // 'ending_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]),
                  'ending_date' =>date($row[9]),
                  'base' =>$row[10],
                  'work_place' =>$row[10],
                  // 'sub_location' =>NULL,
                  'basic_salary' =>$row[12],
                  'gross_salary' =>$row[13],
                  'pf_amount' =>$row[16],
                  // 'pf_percentage' =>$NULL,
                  'status' =>1,
                  'created_by' =>Auth::user()->id,
                  'updated_by' =>Auth::user()->id,
              );
              // }
          }
      }

        // dd($insert_data);
        // exit;
        // dd($insert_data[7]);
        // exit;

      if (!empty($insert_data)) {
          DB::table('employees')->insert($insert_data);
          return back()->with('success','Employees batch import successfully');
      }
 
      // if (!empty($update_data)) {
      //   DB::table('employees')->update($update_data);
      //   return back()->with('success','Employees batch updated successfully');
      //  }
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

    public function employee_details($staff_code)
    {
      $employees = DB::table('employees')->where('staff_code', $staff_code)->first();

      $total_pf_amounts = DB::table("pf_deposit")->SUM('total_pf');

      $pf_deposits = DB::table('pf_deposit')
                    ->orderBy('deposit_date', 'asc')
                    ->where('staff_code', $staff_code)
                    ->get();

      $levels = Level::all();
      $positions = Position::all();
      $categories = Category::all();
      $bases = Base::all();
      $sub_locations = Sub_location::all();
      $work_places = Work_place::all();
      $departments = DB::table('departments')->get();

      return view('employee.employee_details',compact('employees','pf_deposits','total_pf_amounts','departments','work_places','levels','positions','categories','bases','sub_locations'));       

      // return view('employee.employee_details',compact('employees','pf_deposits','total_pf_amounts'));
    }

    public function edit_employee($id)
    {
      $employee = DB::table('employees')->where('id',$id)->first();
      $levels = Level::all();
      $positions = Position::all();
      $categories = Category::all();
      $bases = Base::all();
      $sub_locations = Sub_location::all();
      $work_places = Work_place::all();
      $departments = DB::table('departments')->get();
      return view('employee.edit_employee',compact('employee','departments','work_places','levels','positions','categories','bases','sub_locations'));
      // return view('employee.edit_employee',compact('employee'));
    }
    public function update_employee(Request $request, $staff_code)
    {
      echo 'hi';
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
      $data['status'] = $request->status;
      $data['created_by'] = Auth::user()->id;
      $data['updated_by'] =  Auth::user()->id;

      DB::table('employees')->where('staff_code',$staff_code)->update($data);
      return redirect()->route('all-employee')->with('success', 'Employee Updated Successfully.');
    }

    public function delete_employee($id)
    {
      DB::table('employees')->where('id',$id)->delete();
      return redirect()->back();
    }

    public function customSearchEmployee(Request $request)
    {
        if(request()->ajax())
          {
            if($request->all())
              {
                $data = DB::table('employees')
                ->select('staff_code','first_name', 'position', 'department_code', 'category', 'level', 'base','work_place')
                ->where('staff_code', $request->staff_code)
                ->where('first_name', $request->first_name)
                ->where('position', $request->position)
                ->where('department_code', $request->department_code)
                ->where('category', $request->category)
                ->where('level', $request->level)
                ->where('base', $request->base)
                ->where('work_place', $request->work_place)
                ->get();
                dd($data);
                exit;
              }
          
          else if($request->staff_code){
            $data = DB::table('employees')
                   ->select('staff_code')
                   ->where('staff_code', $request->staff_code)
                   ->first();
          }

          else if($request->first_name){
            $data = DB::table('employees')
                   ->select('first_name')
                   ->where('first_name', $request->first_name)
                   ->first();
          }

          else if($request->position){
            $data = DB::table('employees')
                   ->select('position')
                   ->where('position', $request->position)
                   ->first();
          }

          else if($request->department_code){
            $data = DB::table('employees')
                   ->select('department_code')
                   ->where('department_code', $request->department_code)
                   ->first();
          }

          else if($request->category){
            $data = DB::table('employees')
                   ->select('category')
                   ->where('category', $request->category)
                   ->first();
          }

          else if($request->base){
            $data = DB::table('employees')
                   ->select('base')
                   ->where('base', $request->base)
                   ->first();
          }

          else if($request->level){
            $data = DB::table('employees')
                   ->select('level')
                   ->where('level', $request->level)
                   ->first();
          }

          else if($request->work_place){
            $data = DB::table('employees')
                   ->select('work_place')
                   ->where('work_place', $request->work_place)
                   ->first();
          }

          else{
            echo 'Not Found';
          }

          return datatables()->of($data)->make(true);

        }

    }
}
