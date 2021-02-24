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
use Auth;

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
      $info['level'] = Level::get();
      $info['position'] = Position::get();
      $info['category'] = Category::get();
      $info['base'] = Base::get();
      $info['work_place'] = Work_place::get();
      $info['department'] = Department::get();
      return view('report.pf_balance_sheet',["employee_code"=>$employee_code, "info"=>$info]);
    }

    public function printPFBalanceSheet(Request $request)
    {
        $staff_code = $request->staff;
        $from_date = date('Y-m-d H:m:s', strtotime($request->from_date_for_balanace));
        $to_date = date('Y-m-d H:m:s', strtotime($request->to_date_for_balance));
        $position =$request->position;
        $base = $request->base;
        $category = $request->category;
        $work_place = $request->work_place;
        $level = $request->level;
        $department_code = $request->department_code;
        // dd($request->all());
        $date_info['from_date'] = date('d M Y', strtotime($from_date));
        $date_info['to_date'] = date('d M Y', strtotime($to_date));
     
        // echo $to_date;exit();
        // DB::raw('(CASE  WHEN users.status = "0" THEN "User"  WHEN users.status = "1" THEN "Admin" ELSE "SuperAdmin"  END) AS status_lable'

        $interests = DB::table('interests')
                        ->select('interests.staff_code',DB::raw('sum(interests.own) as total_own_interest'),DB::raw('sum(interests.organization) as total_organization_interest'),DB::raw('sum(interests.own) + sum(interests.organization) as total_interest'))
                        ->where('interests.interest_date','>=', $from_date)
              			->where('interests.interest_date','<=', $to_date)
              			->GROUPBY('interests.staff_code')
                        ->get();
        $interests_info = [];
        foreach ($interests as $key => $value) {
        	$interests_info[$value->staff_code] = $value->total_interest;
        }

        if($staff_code != 0) {
          $info = DB::table('pf_deposit')
              ->select('em.*', DB::raw('sum(interests.own) as total_own_interest'),DB::raw('sum(interests.organization) as total_organization_interest'), DB::raw('SUM(pf_deposit.own_pf) AS total_own_pf'),DB::raw('SUM(pf_deposit.organization_pf) AS total_organaization_pf'),DB::raw('SUM(pf_deposit.organization_pf) + SUM(pf_deposit.own_pf) + interests.own + interests.organization AS total_amount'))
              ->leftjoin('employees as em', 'em.staff_code', '=', 'pf_deposit.staff_code')
              ->leftjoin('interests', 'interests.staff_code', '=', 'pf_deposit.staff_code')
              ->where('pf_deposit.deposit_date','>=', $from_date)
              ->where('pf_deposit.deposit_date','<=', $to_date)
              ->where('em.staff_code',$staff_code)
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
              ->GROUPBY('em.staff_code')
              ->get();
              // dd($info);
        // $info = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS total_own_pf,
        //                        SUM(pf_deposit.organization_pf) AS total_organaization_pf,
        //                        interests.own AS total_own_interest,
        //                        interests.organization AS total_organization_interest,
        //                        (SUM(pf_deposit.own_pf)+SUM(pf_deposit.organization_pf)+ interests.own + interests.organization) AS total_amount
        //                        FROM employees
        //                        left JOIN pf_deposit ON pf_deposit.staff_code=employees.staff_code
        //                        INNER JOIN interests ON interests.staff_code = pf_deposit.staff_code
        //                        WHERE employees.staff_code=".$staff_code." AND deposit_date >= '".$from_date."' AND deposit_date <= '".$to_date."'");
      }else {
        $employee_code = DB::table('employees')->select('staff_code')->get();
        // $info = [];
        //foreach ($employee_code as $key => $value) {
          // $info = DB::select("SELECT employees.*, sum(pf_deposit.own_pf) AS total_own_pf,
          //                      sum(pf_deposit.organization_pf) AS total_organaization_pf,
          //                      interests.own AS total_own_interest,
          //                      interests.organization AS total_organization_interest,
          //                      (sum(pf_deposit.own_pf) + sum(pf_deposit.organization_pf) + interests.own + interests.organization) AS total_amount
          //                      FROM employees
          //                      left JOIN pf_deposit ON pf_deposit.staff_code=employees.staff_code
          //                      INNER JOIN interests ON interests.staff_code = pf_deposit.staff_code
          //                      WHERE deposit_date >= '".$from_date."' AND deposit_date <= '".$to_date."' group by employees.staff_code");

        $info = DB::table('employees as em')
              ->select('em.*')
              ->addselect(DB::raw('SUM(interests.own) AS total_own_interest'), DB::raw('SUM(interests.organization) AS total_organization_interest'))
              ->addselect(DB::raw('SUM(pf_deposit.own_pf) AS total_own_pf'),DB::raw('SUM(pf_deposit.organization_pf) AS total_organaization_pf'),DB::raw('SUM(pf_deposit.organization_pf) + SUM(pf_deposit.own_pf) + interests.own + interests.organization AS total_amount'))
              ->join('pf_deposit', 'pf_deposit.staff_code', '=', 'em.staff_code')
              ->leftjoin('interests', 'interests.staff_code', '=', 'pf_deposit.staff_code')
              ->where('pf_deposit.deposit_date','>=', $from_date)
              ->where('pf_deposit.deposit_date','<=', $to_date)
              ->where(function($q) use($from_date){
                if ($from_date) {
                  $q->where('em.ending_date', '>=', $from_date)
                     ->orWhere('em.status',1);
                }
              })
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
              ->GROUPBY('em.staff_code')
              ->get();
            // dd($data);
       // }

      }
      // dd($info);
        // print_r($info);exit();
        return view('report.print_pf_balance_sheet',["info"=>$info, "date_info"=>$date_info,'interests_info'=>$interests_info]);
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
              // dd($data);
        return json_encode($data);
    }


    public function generateStaffSettlement(Request $request)
    {
      $employees = DB::table('employees')->get();
      return view('report.staff_settlement',["employees"=>$employees]);
    }

    public function printStaffSettlement(Request $request,$staff_code)
    {

        // $staff_code = $request->staff;

        $settlement_date = date('Y-m-d', strtotime($request->settlement_date));
        // dd($settlement_date);

        // $employee_expire_date = DB::select("SELECT ending_date FROM employees WHERE staff_code =".$staff_code);

        // if (!empty($employee_expire_date)) {
        //     return back()->with('error', 'This employee already settlement.');
        // }else{
        //   DB::table('employees')->where('staff_code',$staff_code)->update(['ending_date' => $settlement_date ]);
        // }

        // dd($employee_expire_date);

        // $data1['employee_and_employer_contribution']= DB::select("SELECT SUM(own_pf) AS employee_contribution, SUM(organization_pf) AS employer_contribution FROM pf_deposit WHERE staff_code =".$staff_code);
        // dd($test_data);
        $data1['userInfo'] = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS employee_contribution, SUM(pf_deposit.organization_pf) AS employer_contribution
          FROM employees
          INNER JOIN pf_deposit ON pf_deposit.staff_code = employees.staff_code
          WHERE employees.staff_code = ".$staff_code);

          // dd($data1['userInfo']);

        $data1['data'] = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS employee_contribution, SUM(pf_deposit.organization_pf) AS employer_contribution, interests.own AS interest_percent,
          loans.loan_amount, loans.monthly_installment, loans.monthly_interest, loans.interest, loans.issue_date
          FROM employees
          INNER JOIN pf_deposit ON pf_deposit.staff_code = employees.staff_code
          left JOIN interests ON interests.staff_code = pf_deposit.staff_code
          left JOIN loans ON loans.staff_code = interests.staff_code
          WHERE employees.staff_code = ".$staff_code);

        // dd($data);
        // print_r($data);exit();
        $data1['loan_details'] = DB::select("SELECT SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN loan_installment.payment ELSE 0 END)) AS with_interest_paid_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN loan_installment.payment ELSE 0 END)) AS with_interest_due_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN loans.monthly_installment ELSE 0 END)) AS without_interest_paid_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN loans.monthly_installment ELSE 0 END)) AS without_interest_due_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN 1 ELSE 0 END)) AS num_of_paid_installment,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN 1 ELSE 0 END)) AS num_of_due_installment
                 FROM loan_installment
                 INNER JOIN loans ON loans.staff_code = loan_installment.staff_code
                 WHERE loan_installment.staff_code = ".$staff_code);

        $data1['total_pf_deposits'] = DB::select("SELECT pf_deposit.*, COUNT(deposit_date) AS total_provident_fund
                FROM pf_deposit
                WHERE staff_code = ".$staff_code);

        $data1['to_interest'] = DB::select("SELECT sum(interests.own) as own_interest, sum(interests.organization) as org_interest
                FROM interests
                WHERE staff_code = ".$staff_code);

        // dd($to_interest[0]->own_interest);
        // ['total_pf_interests'=>$total_pf_interests,'total_pf_deposits'=>$total_pf_deposits,'data'=>$loan_data,'loan_details'=>$loan_details,'userInfo'=>$userInfo]
        $data1['total_pf_interests'] = DB::select("SELECT interests.*, COUNT(interest_date) AS total_provident_fund_interest
                FROM interests
                WHERE staff_code = ".$staff_code);
      return view('report.print_staff_settlement',$data1);
}


    public function generateEmployeeHistory(Request $request)
    {
      $employees = DB::table('employees')->get();
      return view('report.employee_history',["employees"=>$employees]);
    }

    public function printEmployeeHistory(Request $request)
    {
        $staff_code = $request->staff;
        $data1['settlement_amount'] = DB::select("select ifnull(settlement_amount,0) as settlement_amount from pf_settlement where staff_code =".$staff_code);

        // dd($data1['settlement_amount']);

        // if($settlement){
        //   $data1['settlement_amount'] = $settlement;
        //  }else{
        //   $data1['settlement_amount'] = 0;
        //  }

        // $data1['employee_and_employer_contribution']= DB::select("SELECT SUM(own_pf) AS employee_contribution, SUM(organization_pf) AS employer_contribution FROM pf_deposit WHERE staff_code =".$staff_code);
        // dd($test_data);
        $data1['userInfo'] = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS employee_contribution, SUM(pf_deposit.organization_pf) AS employer_contribution
          FROM employees
          INNER JOIN pf_deposit ON pf_deposit.staff_code = employees.staff_code
          WHERE employees.staff_code = ".$staff_code);

          // dd($data1['userInfo']);

        $data1['data'] = DB::select("SELECT employees.*, SUM(pf_deposit.own_pf) AS employee_contribution, SUM(pf_deposit.organization_pf) AS employer_contribution, interests.own AS interest_percent,
          loans.loan_amount, loans.monthly_installment, loans.monthly_interest, loans.interest, loans.issue_date
          FROM employees
          INNER JOIN pf_deposit ON pf_deposit.staff_code = employees.staff_code
          left JOIN interests ON interests.staff_code = pf_deposit.staff_code
          left JOIN loans ON loans.staff_code = interests.staff_code
          WHERE employees.staff_code = ".$staff_code);

        // dd($data);
        // print_r($data);exit();
        $data1['loan_details'] = DB::select("SELECT SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN loan_installment.payment ELSE 0 END)) AS with_interest_paid_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN loan_installment.payment ELSE 0 END)) AS with_interest_due_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN loans.monthly_installment ELSE 0 END)) AS without_interest_paid_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN loans.monthly_installment ELSE 0 END)) AS without_interest_due_loan,
                 SUM((CASE WHEN (loan_installment.payment_type = 'paid') THEN 1 ELSE 0 END)) AS num_of_paid_installment,
                 SUM((CASE WHEN (loan_installment.payment_type = 'Due') THEN 1 ELSE 0 END)) AS num_of_due_installment
                 FROM loan_installment
                 INNER JOIN loans ON loans.staff_code = loan_installment.staff_code
                 WHERE loan_installment.staff_code = ".$staff_code);

        $data1['total_pf_deposits'] = DB::select("SELECT pf_deposit.*, COUNT(deposit_date) AS total_provident_fund
                FROM pf_deposit
                WHERE staff_code = ".$staff_code);

        $data1['to_interest'] = DB::select("SELECT sum(interests.own) as own_interest, sum(interests.organization) as org_interest
                FROM interests
                WHERE staff_code = ".$staff_code);

        // dd($to_interest[0]->own_interest);
        $data1['total_pf_interests'] = DB::select("SELECT interests.*, COUNT(interest_date) AS total_provident_fund_interest
                FROM interests
                WHERE staff_code = ".$staff_code);

      return view('report.print_employee_history',$data1);


        // return view('report.print_employee_history',['total_pf_deposits'=>$total_pf_deposits,'total_pf_interests'=>$total_pf_interests,'data'=>$data,'loan_details'=>$loan_details,'userInfo'=>$userInfo,'to_interest'=>$to_interest]);
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

        $incomes = DB::select("SELECT account_heads.account_head,  SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM account_heads
         INNER JOIN transactions ON transactions.account_head_id = account_heads.id
         WHERE account_heads.account_type = 'INCOME' and transactions.is_bank_book = 1
         GROUP BY transactions.account_head_id");

      $expens = DB::select("SELECT account_heads.account_head,  SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM account_heads
         INNER JOIN transactions ON transactions.account_head_id = account_heads.id
         WHERE (transactions.account_head_id != 3 and account_heads.account_type = 'EXPENSE') and transactions.is_bank_book = 1
         GROUP BY transactions.account_head_id");

       // $interest = DB::select("SELECT SUM(IF(interests.interest_date < '".$from_date."' ,interests.own,0)) AS own_form,SUM(IF(interests.interest_date <= '".$from_date."' ,interests.organization,0)) AS organization_form, SUM(IF(interests.interest_date >= '".$from_date."' AND interests.interest_date <= '".$to_date."',interests.own,0)) AS own_to, SUM(IF(interests.interest_date >= '".$from_date."' AND interests.interest_date <= '".$to_date."',interests.organization,0)) AS organization_to FROM interests");

      $interest = DB::select("SELECT SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` inner join account_heads on account_heads.id = transactions.account_head_id where account_heads.account_type = 'INCOME' and transactions.is_bank_book = 1");
      

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
        $day_diff = date_diff(date_create($request->from_date), date_create($request->to_date));
        $day = $day_diff->days + 1;
        $days = "-".$day." days";
        // dd($days);
        $prvious_from_date = date('Y-m-d', strtotime($days, strtotime($from_date)));

        $heading_pre_date = date('Y-m-d', strtotime('-1 days', strtotime($from_date)));
        // dd($prvious_from_date);
        $date_info['from_date'] = date('d M Y', strtotime($heading_pre_date));
        $date_info['to_date'] = date('d M Y', strtotime($request->to_date));

        $investment = DB::select("SELECT account_heads.account_head,SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` inner join account_heads on account_heads.id = transactions.account_head_id where account_heads.account_type = 'INCOME' and transactions.is_bank_book = 1 GROUP BY transactions.account_head_id");
        // dd($investment);
       $pay1 = DB::select("SELECT account_heads.account_head,SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` inner join account_heads on account_heads.id = transactions.account_head_id where (account_heads.account_type = 'EXPENSE' or (account_heads.account_type = 'ASSET' and transactions.amount < 0) ) and transactions.is_bank_book = 1 GROUP BY transactions.account_head_id");

      $pay2 = DB::select("SELECT SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE account_head_id = 12114 and transactions.is_bank_book = 1");

      $pay3 = DB::select("SELECT SUM(IF(transactions.transaction_date <='".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE account_head_id = 3 and transactions.is_bank_book = 1");

      $closing_bal = DB::select("SELECT SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` inner join account_heads on account_heads.id = transactions.account_head_id where account_heads.account_type != 'LIABILITY' and account_heads.account_type != 'ASSET' and transactions.is_bank_book = 1");

       $contribution = DB::select("SELECT SUM(IF(pf_deposit.deposit_date < '".$from_date."' ,pf_deposit.own_pf,0)) AS own_formAmount, SUM(IF(pf_deposit.deposit_date >= '".$from_date."' AND pf_deposit.deposit_date <= '".$to_date."' ,pf_deposit.own_pf,0)) AS own_toAmount,SUM(IF(pf_deposit.deposit_date < '".$from_date."' ,pf_deposit.organization_pf,0)) AS organization_formAmount, SUM(IF(pf_deposit.deposit_date >= '".$from_date."' AND pf_deposit.deposit_date <= '".$to_date."' ,pf_deposit.organization_pf,0)) AS organization_toAmount FROM pf_deposit");

       $opening_bal =  DB::select("SELECT account_heads.account_head,SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` inner join account_heads on account_heads.id = transactions.account_head_id where (account_heads.id = 12113 or account_heads.id = 12123 or account_heads.id = 12114) and transactions.is_bank_book = 1 GROUP BY transactions.account_head_id");
       
       $form_new_em_con = ($opening_bal[0]->formAmount + $opening_bal[1]->formAmount + $opening_bal[2]->formAmount)/2 + $contribution[0]->own_formAmount + $contribution[0]->own_toAmount;
       
       $to_new_em_con = ($opening_bal[0]->formAmount + $opening_bal[1]->formAmount + $opening_bal[2]->formAmount)/2 + $contribution[0]->organization_formAmount + $contribution[0]->organization_toAmount;
       

      return view('report.print_receipts_payment_statement',["date_info"=>$date_info,'investment'=>$investment,'pay1'=>$pay1,'pay2'=>$pay2,'pay3'=>$pay3,'contribution'=>$contribution,'closing_bal'=>$closing_bal,'form_new_em_con'=>$form_new_em_con,'to_new_em_con'=>$to_new_em_con ]);
    }

    public function financialStatement()
    {

      return view('report.financial_statement');
    }

    public function printFinancialStatement(Request $request)
    {
        $from_date = date('Y-m-d H:m:s', strtotime($request->from_date));
        $to_date = date('Y-m-d H:m:s', strtotime($request->to_date));
        $day_diff = date_diff(date_create($request->from_date), date_create($request->to_date));
        $day = $day_diff->days + 1;
        $days = "-".$day." days";
        // dd($days);
        $prvious_from_date = date('Y-m-d', strtotime($days, strtotime($from_date)));

        $heading_pre_date = date('Y-m-d', strtotime('-1 days', strtotime($from_date)));
        // dd($prvious_from_date);
        $date_info['from_date'] = date('d M Y', strtotime($heading_pre_date));
        $date_info['to_date'] = date('d M Y', strtotime($request->to_date));



        $contribution = DB::select("SELECT SUM(IF(pf_deposit.deposit_date < '".$from_date."' ,pf_deposit.own_pf,0)) AS own_formAmount, SUM(IF(pf_deposit.deposit_date >= '".$from_date."' AND pf_deposit.deposit_date <= '".$to_date."' ,pf_deposit.own_pf,0)) AS own_toAmount,SUM(IF(pf_deposit.deposit_date < '".$from_date."' ,pf_deposit.organization_pf,0)) AS organization_formAmount, SUM(IF(pf_deposit.deposit_date >= '".$from_date."' AND pf_deposit.deposit_date <= '".$to_date."' ,pf_deposit.organization_pf,0)) AS organization_toAmount FROM pf_deposit");


        $incomes = DB::select("SELECT  SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM account_heads
         INNER JOIN transactions ON transactions.account_head_id = account_heads.id
         WHERE account_heads.account_type = 'INCOME' and transactions.is_bank_book = 1");

       $expens = DB::select("SELECT SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM account_heads
         INNER JOIN transactions ON transactions.account_head_id = account_heads.id
         WHERE (transactions.account_head_id != 3 and account_heads.account_type = 'EXPENSE') and transactions.is_bank_book = 1");
  

      $from_surface_expendature = $incomes[0]->formAmount + $expens[0]->formAmount;
      $to_surface_expendature =   $incomes[0]->toAmount + $expens[0]->toAmount;
      
      $payment_to_member = DB::select("SELECT SUM(IF(transactions.transaction_date <='".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` WHERE account_head_id = 3 and transactions.is_bank_book = 1");

       $current_liability = DB::select("SELECT SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM transactions inner join account_heads on account_heads.id = transactions.account_head_id where account_heads.account_type = 'LIABILITY' and transactions.is_bank_book = 1");
      
      $closing_bal = $contribution[0]->own_formAmount + $contribution[0]->organization_formAmount + $from_surface_expendature + $payment_to_member[0]->formAmount + $current_liability[0]->formAmount;
      $opening_bal = $contribution[0]->own_toAmount + $contribution[0]->organization_toAmount + $to_surface_expendature + $payment_to_member[0]->toAmount + $current_liability[0]->toAmount + $closing_bal;


       $receipt = DB::select("SELECT SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` inner join account_heads on account_heads.id = transactions.account_head_id where account_heads.account_type = 'INCOME' and transactions.is_bank_book = 1");

      $investment = DB::select("SELECT account_heads.account_head, SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` inner join account_heads on account_heads.id = transactions.account_head_id where account_heads.account_type = 'ASSET' and transactions.is_bank_book = 1");

      
       $payment = DB::select("SELECT SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions` inner join account_heads on account_heads.id = transactions.account_head_id where (account_heads.account_type = 'EXPENSE' or (account_heads.account_type = 'ASSET' and transactions.amount < 0) ) and transactions.is_bank_book = 1");


      $from_cash_at_bank = $contribution[0]->own_formAmount + $contribution[0]->organization_formAmount + $receipt[0]->formAmount + $payment[0]->formAmount;

      $to_cash_at_bank = $from_cash_at_bank + $contribution[0]->own_toAmount + $contribution[0]->organization_toAmount + $receipt[0]->toAmount + $payment[0]->toAmount;


       $current_asset = DB::select("SELECT SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM `transactions`  inner join account_heads on account_heads.id = transactions.account_head_id where account_heads.account_type != 'LIABILITY' and account_heads.account_type != 'ASSET' and transactions.is_bank_book = 1");

      $current_liabilites = DB::select("SELECT account_heads.account_head, SUM(IF(transactions.transaction_date < '".$from_date."' ,transactions.amount,0)) AS formAmount, SUM(IF(transactions.transaction_date >= '".$from_date."' AND transactions.transaction_date <= '".$to_date."',transactions.amount,0)) AS toAmount FROM transactions inner join account_heads on account_heads.id = transactions.account_head_id where account_heads.account_type = 'LIABILITY' and transactions.is_bank_book = 1 GROUP BY transactions.account_head_id");
      // dd($current_liabilites);
      return view('report.print_financial_statement',["date_info"=>$date_info,'closing_bal'=>$closing_bal,'opening_bal'=>$opening_bal,'current_liabilites'=>$current_liabilites,'current_asset'=>$current_asset,'from_surface_expendature'=>$from_surface_expendature,'to_surface_expendature'=>$to_surface_expendature,'investment'=>$investment,'from_cash_at_bank'=>$from_cash_at_bank,'to_cash_at_bank'=>$to_cash_at_bank]);
    }
}