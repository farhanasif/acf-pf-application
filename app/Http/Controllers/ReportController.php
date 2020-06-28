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

        $date_info['from_date'] = date('d M Y', strtotime($from_date));
        $date_info['to_date'] = date('d M Y', strtotime($to_date));
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
        return view('report.print_pf_balance_sheet',["info"=>$info, "date_info"=>$date_info]);
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


    public function generateStaffSettlement(Request $request)
    {
      $employees = DB::table('employees')->get();
      return view('report.staff_settlement',["employees"=>$employees]);
    }

    public function printStaffSettlement(Request $request)
    {
        $staff_code = $request->staff;
        $userInfo = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS employee_contribution, SUM(pf_deposit.organization_pf) AS employer_contribution, interests.own AS interest_percent
          FROM employees
          INNER JOIN pf_deposit ON pf_deposit.staff_code = employees.staff_code
          left JOIN interests ON interests.staff_code = pf_deposit.staff_code
          WHERE employees.staff_code = ".$staff_code);

        $loan_data = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS employee_contribution, SUM(pf_deposit.organization_pf) AS employer_contribution, interests.own AS interest_percent,
          loans.loan_amount, loans.monthly_installment, loans.monthly_interest, loans.interest, loans.issue_date
          FROM employees
          INNER JOIN pf_deposit ON pf_deposit.staff_code = employees.staff_code
          left JOIN interests ON interests.staff_code = pf_deposit.staff_code
          left JOIN loans ON loans.staff_code = interests.staff_code
          WHERE employees.staff_code = ".$staff_code);
        // print_r($data);exit();
        $loan_details = DB::select("SELECT SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN loan_installment.payment ELSE 0 END)) AS with_interest_paid_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN loan_installment.payment ELSE 0 END)) AS with_interest_due_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN loans.monthly_installment ELSE 0 END)) AS without_interest_paid_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN loans.monthly_installment ELSE 0 END)) AS without_interest_due_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN 1 ELSE 0 END)) AS num_of_paid_installment,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN 1 ELSE 0 END)) AS num_of_due_installment
                 FROM loan_installment
                 INNER JOIN loans ON loans.staff_code = loan_installment.staff_code
                 WHERE loan_installment.staff_code = ".$staff_code);

        return view('report.print_staff_settlement',['data'=>$loan_data,'loan_details'=>$loan_details,'userInfo'=>$userInfo]);
    }

    public function generateEmployeeHistory(Request $request)
    {
      $employees = DB::table('employees')->get();
      return view('report.employee_history',["employees"=>$employees]);
    }

    public function printEmployeeHistory(Request $request)
    {
        $staff_code = $request->staff;
        $userInfo = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS employee_contribution, SUM(pf_deposit.organization_pf) AS employer_contribution, interests.own AS interest_percent
          FROM employees
          INNER JOIN pf_deposit ON pf_deposit.staff_code = employees.staff_code
          left JOIN interests ON interests.staff_code = pf_deposit.staff_code
          WHERE employees.staff_code = ".$staff_code);
        $data = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS employee_contribution, SUM(pf_deposit.organization_pf) AS employer_contribution, interests.own AS interest_percent,
          loans.loan_amount, loans.monthly_installment, loans.monthly_interest, loans.interest, loans.issue_date
          FROM employees
          INNER JOIN pf_deposit ON pf_deposit.staff_code = employees.staff_code
          left JOIN interests ON interests.staff_code = pf_deposit.staff_code
          left JOIN loans ON loans.staff_code = interests.staff_code
          WHERE employees.staff_code = ".$staff_code);
        // print_r($data);exit();
        $loan_details = DB::select("SELECT SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN loan_installment.payment ELSE 0 END)) AS with_interest_paid_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN loan_installment.payment ELSE 0 END)) AS with_interest_due_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN loans.monthly_installment ELSE 0 END)) AS without_interest_paid_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN loans.monthly_installment ELSE 0 END)) AS without_interest_due_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN 1 ELSE 0 END)) AS num_of_paid_installment,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN 1 ELSE 0 END)) AS num_of_due_installment
                 FROM loan_installment
                 INNER JOIN loans ON loans.staff_code = loan_installment.staff_code
                 WHERE loan_installment.staff_code = ".$staff_code);

        return view('report.print_employee_history',['data'=>$data,'loan_details'=>$loan_details,'userInfo'=>$userInfo]);
    }

    public function incomeExpenditureReport()
    {

      return view('report.income_expenditure_report');
    }

    public function printIncomeExpenditureReport(Request $request)
    {
        $from_date = date('Y-m-d H:m:s', strtotime($request->from_date));
        $to_date = date('Y-m-d H:m:s', strtotime($request->to_date));

        $date_info['from_date'] = date('d M Y', strtotime($from_date));
        $date_info['to_date'] = date('d M Y', strtotime($to_date));

        $incomes = DB::select("SELECT account_heads.account_head,  SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM account_heads
         INNER JOIN transactions ON transactions.account_head_id = account_heads.id
         WHERE account_heads.account_type = 'INCOME'
         GROUP BY transactions.account_head_id");

       $expens = DB::select("SELECT account_heads.account_head,  SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM account_heads
         INNER JOIN transactions ON transactions.account_head_id = account_heads.id
         WHERE account_heads.account_type = 'EXPENSE'
         GROUP BY transactions.account_head_id");

       $interest = DB::select("SELECT SUM(IF(interests.interest_date <= '".$from_date."' ,interests.own,0)) AS own_form,SUM(IF(interests.interest_date <= '".$from_date."' ,interests.organization,0)) AS organization_form, SUM(IF(interests.interest_date >= '".$from_date."' AND interests.interest_date <= '".$to_date."',interests.own,0)) AS own_to, SUM(IF(interests.interest_date >= '".$from_date."' AND interests.interest_date <= '".$to_date."',interests.organization,0)) AS organization_to FROM interests");

      return view('report.print_income_expenditure_report',["date_info"=>$date_info,'incomes'=>$incomes,'expens'=>$expens,'interest'=>$interest]);
    }

    public function receiptsPaymentStatement()
    {

      return view('report.receipts_payment_statement');
    }

    public function printReceiptsPaymentStatement(Request $request)
    {
        $from_date = date('Y-m-d H:m:s', strtotime($request->from_date));
        $to_date = date('Y-m-d H:m:s', strtotime($request->to_date));

        $date_info['from_date'] = date('d M Y', strtotime($request->from_date));
        $date_info['to_date'] = date('d M Y', strtotime($request->to_date));

        $investment = DB::select("SELECT SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE account_head_id = 12123");

       $pay1 = DB::select("SELECT SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE account_head_id = 12112");

      $pay2 = DB::select("SELECT SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE account_head_id = 12114");

      $pay3 = DB::select("SELECT SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE account_head_id = 3");

      $closing_bal = DB::select("SELECT SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE is_bank_book = 1");

       $contribution = DB::select("SELECT SUM(IF(pf_deposit.deposit_date <= '".$from_date."' ,pf_deposit.own_pf,0)) AS own_formAmount, SUM(IF(pf_deposit.deposit_date >= '".$from_date."' AND pf_deposit.deposit_date <= '".$to_date."' ,pf_deposit.own_pf,0)) AS own_toAmount,SUM(IF(pf_deposit.deposit_date <= '".$from_date."' ,pf_deposit.organization_pf,0)) AS organization_formAmount, SUM(IF(pf_deposit.deposit_date >= '".$from_date."' AND pf_deposit.deposit_date <= '".$to_date."' ,pf_deposit.organization_pf,0)) AS organization_toAmount FROM pf_deposit");

      return view('report.print_receipts_payment_statement',["date_info"=>$date_info,'investment'=>$investment,'pay1'=>$pay1,'pay2'=>$pay2,'pay3'=>$pay3,'contribution'=>$contribution,'closing_bal'=>$closing_bal]);
    }

    public function financialStatement()
    {

      return view('report.financial_statement');
    }

    public function printFinancialStatement(Request $request)
    {
        $from_date = date('Y-m-d H:m:s', strtotime($request->from_date));
        $to_date = date('Y-m-d H:m:s', strtotime($request->to_date));

        $date_info['from_date'] = date('d M Y', strtotime($from_date));
        $date_info['to_date'] = date('d M Y', strtotime($to_date));
        // print_r($date_info);die();
        $investment = DB::select("SELECT SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE account_head_id = 12112");

       $current_asset = DB::select("SELECT SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE is_bank_book = 1");

       $contribution = DB::select("SELECT SUM(IF(pf_deposit.deposit_date <= '".$from_date."' ,pf_deposit.own_pf,0)) AS own_formAmount, SUM(IF(pf_deposit.deposit_date >= '".$from_date."' AND pf_deposit.deposit_date <= '".$to_date."' ,pf_deposit.own_pf,0)) AS own_toAmount,SUM(IF(pf_deposit.deposit_date <= '".$from_date."' ,pf_deposit.organization_pf,0)) AS organization_formAmount, SUM(IF(pf_deposit.deposit_date >= '".$from_date."' AND pf_deposit.deposit_date <= '".$to_date."' ,pf_deposit.organization_pf,0)) AS organization_toAmount FROM pf_deposit");

      $current_liabilites = DB::select("SELECT SUM(IF(transactions.transaction_date <= '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM transactions WHERE is_bank_book = 12126");

      return view('report.print_financial_statement',["date_info"=>$date_info,'investment'=>$investment,'current_asset'=>$current_asset,'contribution'=>$contribution,'current_liabilites'=>$current_liabilites]);
    }
}
