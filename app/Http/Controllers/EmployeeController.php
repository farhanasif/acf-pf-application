<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function add_employee()
    {
      return view('employee.add_employee');
    }

    public function all_employee()
    {
      return view('employee.all_employee');
    }

    public function employee_batch_upload()
    {
      return view('employee.employee_batch_upload');
    }

    // public function save_employee(Request $request)
    // {
    //    $employees = new Employee;
    //
    // }
}
