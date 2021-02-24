<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

        $total_employees = DB::table("employees")->count('staff_code');
        $total_loans = DB::select('SELECT COUNT(DISTINCT staff_code) AS total_loan, SUM(loan_amount) AS total_loan_amount FROM loans');

        // $contribution = DB::select('select sum(own_pf) as employer_contribution, sum(organization_pf) as employee_contribution from pf_deposit');
        
        $employer_contribution = DB::table('pf_deposit')->sum('own_pf');
        $employee_contribution = DB::table('pf_deposit')->sum('organization_pf');

        $total_employee_under_loan = DB::select('SELECT COUNT(DISTINCT staff_code) AS total_pf_staff FROM pf_deposit;');
    	return view('admin_home',compact('total_employee_under_loan','total_loans','total_employees','employee_contribution','employer_contribution'));
    }
}
