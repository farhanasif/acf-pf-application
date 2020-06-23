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
        $data['levels'] = Level::all();
        $data['positions'] = Position::all();
        $data['categories'] = Category::all();
        $data['bases'] = Base::all();
        $data['sub_locations'] = Sub_location::all();
        $data['work_places'] = Work_place::all();
        $data['departments'] = DB::table('departments')->get();
        // print_r($data);
        // exit;

        return view('employee.add_employee',$data);
    }

    public function all_employee(Request $request)
    {

      $query = "select * from employees";

      $data['positions'] = DB::table('positions')->get();
      $data['categories'] = DB::table('categories')->get();
      $data['bases'] = DB::table('bases')->get();
      $data['levels'] = DB::table('levels')->get();
      $data['departments'] = DB::table('departments')->get();
      $data['work_places'] = DB::table('work_places')->get();
      $data['all_employees'] = DB::table('employees')->get();

      if ($request->isMethod('post')) {
          $position = $request->position;
          $category = $request->category;
          $base = $request->base;
          $level = $request->level;
          $work_place = $request->work_place;
          $department_code = $request->department_code;
          $staff_code = $request->staff_code;
          $name = $request->name;

          if($category == '-1' && $position == '-1' && $base == '-1' && $level == '-1' && $work_place == '-1' && $department_code == '-1' && $staff_code == '-1' && $name == '-1'){
          }
          else{
              $query = $query. " where 1=1 ";

              if($staff_code != '-1'){
                $query = $query . " AND staff_code = '".$staff_code."'";
              }

              if($name != '-1'){
                $query = $query . " AND staff_code= '".$name."'";
              }

              if($position != '-1'){
                  $query = $query . " AND position = '".$position."'";
              }

              if($category != '-1'){
                  $query = $query . " AND category = '".$category."'";
              }

              if($base != '-1'){
                $query = $query . ' AND base = "'.$base.'"';
              }

              if($level != '-1'){
                  $query = $query . " AND level = '".$level."'";
              }

              if($work_place != '-1'){
                $query = $query . ' AND work_place = "'.$work_place.'"';
              }

              if($department_code != '-1'){
                  $query = $query . " AND department_code = '".$department_code."'";
              }

          }
          $data['employees'] = DB::select($query);
          return view('employee.all_employee',$data);
      }
      else{

          $data['employees'] = DB::select($query);
          return view('employee.all_employee',$data);
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
        $accept_files = ["csv", "xlsx"];
        if(!in_array($ext, $accept_files)) {
            return redirect()->back()
            ->with('error', 'Invalid file extension. permitted file is .csv & .xlsx');
        }
        // get the file
        $upload = $request->file('file');
        $filePath = $upload->getRealPath();

        if($ext == "xlsx" || $ext == "csv") {
        $result = Excel::toArray(new EmployeesImport, $upload);

        foreach ($result as  $key => $value) {
          foreach ($value as $row) {
                    $insert_data[] =array(
                      'staff_code' =>$row[0],
                      'trimmed' =>$row[0],
                      'first_name' =>$row[1],
                      'last_name' =>$row[2],
                      'position' =>$row[3],
                      'department_code' =>$row[4],
                      'category' =>$row[4],
                      'level' =>$row[5],
                      'joining_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['7'])->format('Y-m-d'),
                    //'joining_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7]),
                      // 'ending_date' =>date('Y-m-d H:m:s', strtotime($row[9])),
                      'ending_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['9'])->format('Y-m-d') != "00/00/0000" ?  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['9'])->format('Y-m-d') : '00/00/0000' ,
                      'base' =>$row[10],
                      'work_place' =>$row[10],
                      'sub_location' =>$row[10],
                      'basic_salary' =>$row[12],
                      'gross_salary' =>$row[13],
                      'pf_amount' =>$row[16],
                      // 'pf_percentage' =>$NULL,
                      'status' =>1,
                      'created_by' =>Auth::user()->id,
                      'updated_by' =>Auth::user()->id,
                  );
          }
      }

        dd($insert_data);
        exit;

      if (!empty($insert_data)) {
          DB::table('employees')->insert($insert_data);
          return back()->with('success','Employees batch import successfully');
      }
    }
}

    public function save_employee(Request $request)
    {
       $this->validate($request,[
        'staff_code' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'position' => 'required',
        'department_code' => 'required',
        'category' => 'required',
        'level' => 'required',
        'base' => 'required',
        'work_place' => 'required',
        'sub_location' => 'required',
        'basic_salary' => 'required',
        'gross_salary' => 'required',
        'pf_amount' => 'required',
        'joining_date' => 'required',
        'ending_date' => 'required',
       ]);

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

      $data['employees'] = DB::table('employees')->where('staff_code', $staff_code)->first();

      // dd($employees);
      // exit;

      $data['loan_account_details'] = DB::select(
              "SELECT
              loans.id, loans.loan_amount, loans.total_months, loans.interest, loans.issue_date,
              MIN(loan_installment.pay_date ) AS min_date, MAX(loan_installment.pay_date ) AS max_date,
              employees.first_name, employees.last_name, employees.position
              FROM loans
              INNER JOIN loan_installment ON loan_installment.staff_code = loans.staff_code
              INNER JOIN employees ON employees.staff_code = loans.staff_code
              WHERE loans.staff_code ='".$staff_code."'");

       $data['interests_and_pf_deposit'] = DB::select("SELECT SUM(pf_deposit.total_pf) AS total_pf_amount, MAX(pf_deposit.total_pf) AS maximum_total_pf, pf_deposit.deposit_date,
            interests.id AS interests_id, interests.own, interests.organization, interests.interest_date, interests.interest_source
            FROM pf_deposit
            LEFT JOIN interests ON interests.staff_code = pf_deposit.staff_code
            WHERE pf_deposit.staff_code='".$staff_code."' ORDER BY deposit_date DESC");

       $data['loan_adjustments'] = DB::select("SELECT  payment, pay_date, payment_type
                                   FROM loan_installment
                                   WHERE staff_code ='".$staff_code."' ORDER BY pay_date ASC");

       $data['pf_deposits'] = DB::table('pf_deposit')
                    ->orderBy('deposit_date', 'asc')
                    ->where('staff_code', $staff_code)
                    ->get();

      $data['levels'] = Level::all();
      $data['positions'] = Position::all();
      $data['categories'] = Category::all();
      $data['bases'] = Base::all();
      $data['sub_locations'] = Sub_location::all();
      $data['work_places'] = Work_place::all();
      $data['departments'] = DB::table('departments')->get();

      return view('employee.employee_details',$data);
    }


    public function edit_employee($id)
    {
      $data['employee'] = DB::table('employees')->where('id',$id)->first();
      $data['levels'] = Level::all();
      $data['positions'] = Position::all();
      $data['categories'] = Category::all();
      $data['bases'] = Base::all();
      $data['sub_locations'] = Sub_location::all();
      $data['work_places'] = Work_place::all();
      $data['departments'] = DB::table('departments')->get();

      return view('employee.edit_employee',$data);
    }
    public function update_employee(Request $request,$staff_code)
    {
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


    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();

     $data = Excel::load($path)->get();

     if($data->count() > 0)
     {
      foreach($data->toArray() as $key => $value)
      {
       foreach($value as $row)
       {
        $insert_data[] = array(
         'CustomerName'  => $row['customer_name'],
         'Gender'   => $row['gender'],
         'Address'   => $row['address'],
         'City'    => $row['city'],
         'PostalCode'  => $row['postal_code'],
         'Country'   => $row['country']
        );
       }
      }

      if(!empty($insert_data))
      {
       DB::table('tbl_customer')->insert($insert_data);
      }
     }
     return back()->with('success', 'Excel Data Imported successfully.');
    }

}
