<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Carbon;
use App\Level;
use App\Position;
use App\Category;
use App\Base;
use App\Sub_location;
use App\Work_place;
use App\Department;
use App\Employee;

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
        $from_date = date('Y-m-d H:m:s', strtotime($request->from_date_for_balanace));
        $to_date = date('Y-m-d H:m:s', strtotime($request->to_date_for_balance));
        // echo $to_date;exit();
        $info = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS total_own_pf, 
                               SUM(pf_deposit.organization_pf) AS total_organaization_pf,
                               interests.own AS total_own_interest, 
                               interests.organization AS total_organization_interest,
                               (SUM(pf_deposit.own_pf)+SUM(pf_deposit.organization_pf)+ interests.own + interests.organization) AS total_amount 
                               FROM employees 
                               left JOIN pf_deposit ON pf_deposit.staff_code=employees.staff_code 
                               INNER JOIN interests ON interests.staff_code = pf_deposit.staff_code 
                               WHERE employees.staff_code=".$staff_code." AND deposit_date >= '".$from_date."' AND deposit_date <= '".$to_date."'");
        // print_r($info);exit();
        return view('report.print_pf_balance_sheet',["info"=>$info]);
    }

    public function loanInstallmentReport()
    {
      $info = [];
      $info['level'] = Level::get();
      $info['position'] = Position::get();
      $info['category'] = Category::get();
      $info['base'] = Base::get();
      $info['work_place'] = Work_place::get();
      $info['department'] = Department::get();
      
      return view('report.loan_installment_report', ["info" => $info]);
    }
    public function loanInstallmentData(Request $request)
    {

        $from_date = date('Y-m-d H:m:s', strtotime($request->from_date));
        $to_date = date('Y-m-d H:m:s', strtotime($request->to_date));
        $position =$request->position;
        $base = $request->base;
        $category = $request->category;
        $work_place = $request->work_place;
        $level = $request->level;
        $department_code = $request->department_code;

        $data = DB::table('employees as em')
              ->join('loan_installment as li', 'li.staff_code', '=', 'em.staff_code')
              ->where('li.pay_date','>=', $from_date)
              ->where('li.pay_date','<=', $to_date)
              ->where(function($q) use($position){
                if ($position) {
                  $q->where('em.position','=', $position);
                }
              })
              ->where(function($q) use($base){
                if ($base) {
                  $q->where('em.base','=', $base);
                }
              })
              ->where(function($q) use($category){
                if ($category) {
                  $q->where('em.category','=', $category);
                }
              })
              ->where(function($q) use($work_place){
                if ($work_place) {
                  $q->where('em.work_place', $work_place);
                }
              })
              ->where(function($q) use($level){
                if ($level) {
                  $q->where('em.level','=', $level);
                }
              })  
              ->where(function($q) use($department_code){
                if ($department_code) {
                  $q->where('em.department_code','=', $department_code);
                }
              })
              ->get();
        return json_encode($data);
    }
}
