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

    public function all_employee(Request $request)
    {

      $query = "select * from employees";
      // $query = DB::table('employees')->paginate(10);
      // dd($query);
      // exit;

      $positions = DB::table('positions')->get();
      $categories = DB::table('categories')->get();
      $bases = DB::table('bases')->get();
      $levels = DB::table('levels')->get();
      $departments = DB::table('departments')->get();
      $work_places = DB::table('work_places')->get();

      if ($request->isMethod('post')) {
          $position = $request->position;
          $category = $request->category;
          $base = $request->base;
          $level = $request->level;
          $work_place = $request->work_place;
          $department_code = $request->department_code;
          $staff_code = $request->staff_code;

          if($category == '-1' && $position == '-1' && $base == '-1' && $level == '-1' && $work_place == '-1' && $department_code == '-1' && $staff_code == '-1'){
          }
          else{
              $query = $query. " where 1=1 ";

              if($staff_code != '-1'){
                $query = $query . " AND staff_code = '".$staff_code."'";

                // dd($query);
                // exit;
              }

              if($position != '-1'){
                  $query = $query . " AND position = '".$position."'";
              }

              if($category != '-1'){
                  $query = $query . " AND category = '".$category."'";
              }

              if($base != '-1'){
                // $query = $query . " AND base = '".$base."'";
                $query = $query . ' AND base = "'.$base.'"';
              }

              if($level != '-1'){
                  $query = $query . " AND level = '".$level."'";

              }

              if($work_place != '-1'){
                // $query = $query . " AND work_place = '".$work_place."'";
                $query = $query . ' AND work_place = "'.$work_place.'"';
              }

              if($department_code != '-1'){
                  $query = $query . " AND department_code = '".$department_code."'";
              }

          }

          // $query = $query.paginate(10);
          $employees = DB::select($query);
          return view('employee.all_employee',compact('employees','positions','categories','levels','bases','departments','work_places'));
      }
      else{
          // $query = $query." limit 10";
          //  $query = $query.''.paginate(10);    
          $employees = DB::select($query);
          // dd($employees);
          // exit;
          return view('employee.all_employee',compact('employees','positions','categories','levels','bases','departments','work_places'));
      }
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

        foreach ($result as $key => $value) {
          foreach ($value as $row) {
                  // try {
                    $insert_data[] =array(
                      'staff_code' =>$row[0],
                      'trimmed' =>$row[0],
                      'first_name' =>$row[1],
                      'last_name' =>$row[2],
                      'position' =>$row[3],
                      // 'department_code' =>NULL,
                      'category' =>$row[4],
                      'level' =>$row[5],
                      'joining_date' =>date($row[7]),
                      // 'ending_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]),
                      'ending_date' =>formatDates($row[9]),
                      // 'ending_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['9'])->format('Y-m-d'),
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
                  // catch (\Exception $e)
                  //   {
                  //     return redirect()->back()->with('error','Something went wrong!');
                  //   }
              // }
          }
      }

        dd($insert_data);
        exit;

      // if (!empty($insert_data)) {
      //     DB::table('employees')->insert($insert_data);
      //     return back()->with('success','Employees batch import successfully');
      // }

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
       $data['base'] = addslashes($request->base);
       $data['work_place'] = addslashes($request->work_place);
       $data['sub_location'] = addslashes($request->sub_location);
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

      // dd($employees);
      // exit;

      $loan_account_details = DB::select(
              "SELECT
              loans.id, loans.loan_amount, loans.total_months, loans.interest, loans.issue_date, 
              MIN(loan_installment.pay_date ) AS min_date, MAX(loan_installment.pay_date ) AS max_date,
              employees.first_name, employees.last_name, employees.position
              FROM loans
              INNER JOIN loan_installment ON loan_installment.staff_code = loans.staff_code
              INNER JOIN employees ON employees.staff_code = loans.staff_code
              WHERE loans.staff_code ='".$staff_code."'");

              // dd($loan_account_details);
              // exit;
              $interests = DB::select("SELECT * FROM interests WHERE staff_code='".$staff_code."'");

              //   dd($interest);
              // exit;
                  
    $total_and_maximum_pf = DB::select(
                "SELECT SUM(total_pf) AS total_pf_amount, MAX(total_pf) AS maximum_total_pf , deposit_date
                FROM pf_deposit WHERE staff_code ='".$staff_code."' ORDER BY deposit_date DESC");

   $loan_adjustments = DB::select("SELECT  payment, pay_date, payment_type
                                   FROM loan_installment 
                                   WHERE staff_code ='".$staff_code."' ORDER BY pay_date ASC");

      $pf_deposits = DB::table('pf_deposit')
                    ->orderBy('deposit_date', 'desc')
                    ->where('staff_code', $staff_code)
                    ->get();

      $levels = Level::all();
      $positions = Position::all();
      $categories = Category::all();
      $bases = Base::all();
      $sub_locations = Sub_location::all();
      $work_places = Work_place::all();
      $departments = DB::table('departments')->get();

      return view('employee.employee_details',compact('interests',
       'loan_account_details','employees','pf_deposits','total_and_maximum_pf',
        'departments','work_places','levels','positions','categories','bases','sub_locations','loan_adjustments'));

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
    public function update_employee(Request $request,$staff_code)
    {   

      //dd($request->status);

      $data = array();
      $data['staff_code'] = $request->staff_code;
      $data['first_name'] = $request->first_name;
      $data['last_name'] = $request->last_name;
      $data['position'] = $request->position;
      $data['department_code'] = $request->department_code;
      $data['category'] = $request->category;
      $data['level'] = $request->level;
      $data['base'] = addslashes($request->base);
      $data['work_place'] = addslashes($request->work_place);
      $data['sub_location'] = addslashes($request->sub_location);
      $data['basic_salary'] = $request->basic_salary;
      $data['gross_salary'] = $request->gross_salary;
      $data['pf_amount'] = $request->pf_amount;
      $data['joining_date'] = $request->joining_date;
      $data['ending_date'] = $request->ending_date;
      $data['status'] = $request->status;
      $data['created_by'] = Auth::user()->id;
      $data['updated_by'] =  Auth::user()->id;

      DB::table('employees')->where('staff_code',$staff_code)->update($data);
      return json_encode("success");
      //return back()->with('success', 'Employee Updated Successfully.');
    }

    public function delete_employee($id)
    {
      DB::table('employees')->where('id',$id)->delete();
      return redirect()->back();
    }

    // public function customSearchEmployee(Request $request)
    // {
    //     if(request()->ajax())
    //       {
    //         if($request->all())
    //           {
    //             $data = DB::table('employees')
    //             ->select('staff_code','first_name', 'position', 'department_code', 'category', 'level', 'base','work_place')
    //             ->where('staff_code', $request->staff_code)
    //             ->where('first_name', $request->first_name)
    //             ->where('position', $request->position)
    //             ->where('department_code', $request->department_code)
    //             ->where('category', $request->category)
    //             ->where('level', $request->level)
    //             ->where('base', $request->base)
    //             ->where('work_place', $request->work_place)
    //             ->get();
    //             dd($data);
    //             exit;
    //           }

    //       else if($request->staff_code){
    //         $data = DB::table('employees')
    //                ->select('staff_code')
    //                ->where('staff_code', $request->staff_code)
    //                ->first();
    //       }

    //       else if($request->first_name){
    //         $data = DB::table('employees')
    //                ->select('first_name')
    //                ->where('first_name', $request->first_name)
    //                ->first();
    //       }

    //       else if($request->position){
    //         $data = DB::table('employees')
    //                ->select('position')
    //                ->where('position', $request->position)
    //                ->first();
    //       }

    //       else if($request->department_code){
    //         $data = DB::table('employees')
    //                ->select('department_code')
    //                ->where('department_code', $request->department_code)
    //                ->first();
    //       }

    //       else if($request->category){
    //         $data = DB::table('employees')
    //                ->select('category')
    //                ->where('category', $request->category)
    //                ->first();
    //       }

    //       else if($request->base){
    //         $data = DB::table('employees')
    //                ->select('base')
    //                ->where('base', $request->base)
    //                ->first();
    //       }

    //       else if($request->level){
    //         $data = DB::table('employees')
    //                ->select('level')
    //                ->where('level', $request->level)
    //                ->first();
    //       }

    //       else if($request->work_place){
    //         $data = DB::table('employees')
    //                ->select('work_place')
    //                ->where('work_place', $request->work_place)
    //                ->first();
    //       }

    //       else{
    //         echo 'Not Found';
    //       }

    //       return datatables()->of($data)->make(true);

    //     }

    // }
}
