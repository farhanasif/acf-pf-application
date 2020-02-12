<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function add_employee()
    {
      return view('employee.add_employee');
    }

    // public function save_employee(Request $request)
    // {
    //    $employees = new Employee;
    //
    // }
}
