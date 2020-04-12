<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Carbon;

class ReportController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function show_provident_fund_report()
    {     
        $provident_funds = DB::table('pf_deposit')->get();
        return view('report.show_provident_fund_report',compact('provident_funds'));
    }

    public function generatePFBalanceSheet(Request $request)
    {
    	$employee_code = DB::table('employees')->get();
    	return view('report.pf_balance_sheet',["employee_code"=>$employee_code]);
    }

    public function printPFBalanceSheet(Request $request)
    {
        $staff_code = $request->staff;
        $date_info = $request->date_for_balance_sheet;
        $date_info = date('Y-m-d H:m:s', strtotime($date_info));
        // echo $date_info;exit();
        $info = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS total_own_pf, 
                               SUM(pf_deposit.organization_pf) AS total_organaization_pf,
                               SUM(interests.own) AS total_own_interest, 
                               SUM(interests.organization) AS total_organization_interest,
                               (SUM(pf_deposit.own_pf)+SUM(pf_deposit.organization_pf)+SUM(interests.own)+SUM(interests.organization)) AS total_amount 
                               FROM employees 
                               INNER JOIN pf_deposit ON pf_deposit.staff_code=employees.staff_code 
                               INNER JOIN interests ON interests.staff_code = pf_deposit.staff_code 
                               WHERE employees.staff_code=".$staff_code." AND deposit_date <= '".$date_info."'");
        // print_r($info);exit();
        return view('report.print_pf_balance_sheet',["info"=>$info]);
    }
}
