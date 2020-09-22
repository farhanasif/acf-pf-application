<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Loan;
use App\LoanInstallment;
use App\Transaction;

use App\Imports\EmployeesImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Auth;
use App\Level;
use App\Position;
use App\Category;
use App\Base;
use App\Sub_location;
use App\Work_place;
use App\Department;
use App\Employee;

class LoanController extends Controller
{
    public function create_loan()
    {
    	$employees= DB::table('employees')->get();
    	$accounts = DB::table('account_heads')->get();
    	return view('loan.create_loan',['employees'=>$employees,'accounts'=>$accounts]);
    }

    public function loanFromData(Request $reuest)
    {
    	$staff_code = $reuest->staff_code;
        // $data = DB::table('employees')->where('staff_code',$staff_code)->first();
    	$data = DB::select("select em.*, sum(pfd.total_pf) as total_pf from employees as em
    		                inner join pf_deposit as pfd on pfd.staff_code = em.staff_code
    		                where em.staff_code='".$staff_code."' limit 1");
    	echo json_encode($data);
    }

    public function saveLoan(Request $request)
    {
      $loan_info = DB::table('loans')->where('staff_code',$request->staff_code)->get();
      // print_r($loan_info);die();
      if(empty($loan_info)) {
    	   	try{

    	       $loan = new Loan;
    	       $loan->staff_code = $request->staff_code;
    	       $loan->monthly_installment = $request->monthly_installment;
    	       $loan->loan_amount = $request->loan_amount;
    	       $loan->total_months =  12;
    	       $loan->monthly_interest = $request->monthly_interest;
    	       $loan->interest  = $request->interest;
    	       $loan->description  = $request->purpose;
    	       $loan->issue_date = date('Y-m-d', strtotime($request->date));
    	       $loan->save();

               // $loan_id = DB::select("select id from loans where staff_code='".$request->staff_code."' ORDER BY created_at DESC limit 1");

    	       for($i = 1; $i <= 12; $i++){
       		       $loanInstallment = new LoanInstallment;
    		       $loanInstallment->staff_code = $request->staff_code;
    		       $loanInstallment->payment_type =  "Due";
    		       $loanInstallment->loan_id = $loan->id;
    		       $loanInstallment->payment = number_format(($request->monthly_installment + $request->monthly_interest),4);
    	       	   $loanInstallment->pay_date  = date ("Y-m-d", strtotime("+".$i." month", strtotime($request->date)));
    	       	   $loanInstallment->save();
    	       	   // echo json_encode($loanInstallment);
    	       }

    	       $transaction = new Transaction;
    	       $transaction->account_head_id = $request->account_head;
    	       $transaction->description = $request->description;
    	       $transaction->amount = $request->loan_amount*-1;
             $transaction->transaction_date = date('Y-m-d H:i:s', strtotime($request->date));
    	       $transaction->save();


    	       echo("Loan application submitted successfully!");
    	       return;
    	   }catch(Exception $e){
                DB::rollback();
                echo $e;
                return;
            }

          }else {
            echo("Already you get a loan!");
            return;
          }

    }

    public function allLoans()
    {
    	$data = DB::select("SELECT loans.loan_amount, loans.total_months, loans.interest, loans.issue_date,
              MIN(loan_installment.pay_date ) AS loan_start_date, MAX(loan_installment.pay_date ) AS loan_end_date,
               COUNT( DISTINCT loans.loan_amount) AS total_loan,
              employees.first_name, employees.last_name, employees.position, employees.staff_code
              FROM loans
              INNER JOIN loan_installment ON loan_installment.loan_id = loans.id
              INNER JOIN employees ON employees.staff_code = loans.staff_code GROUP BY loans.id");
    	// print_r($data);exit();
    	return view('loan.all_loans', compact('data'));
    }

    public function adjustLoan(Request $request, $staff_code)
    {
     $accounts = DB::table('account_heads')->get();
     $loan_account_details = DB::select(
                "SELECT loans.*, employees.*
                 FROM loans
                 INNER JOIN employees ON employees.staff_code = loans.staff_code
                 WHERE loans.staff_code ='".$staff_code."' LIMIT 1");
     // dd($loan_account_details);

      $total_and_maximum_pf = DB::select(
                  "SELECT SUM(total_pf) AS total_pf_amount, MAX(total_pf) AS maximum_total_pf , deposit_date
                  FROM pf_deposit WHERE staff_code ='".$staff_code."' ORDER BY deposit_date DESC");

      $loan_adjustments = DB::select("SELECT  id, payment, pay_date, payment_type
                                     FROM loan_installment
                                     WHERE staff_code ='".$staff_code."' ORDER BY pay_date ASC");
      // print_r($loan_adjustments);die();
      /********************************** fraction issue ************************************************/
      $pay['int_payment'] = (int) $loan_adjustments[0]->payment;
      $pay['fraction_payment'] = (($loan_account_details[0]->loan_amount + $loan_account_details[0]->interest) - $pay['int_payment']*12);
      $pay['int_month_inst'] = (int) $loan_account_details[0]->monthly_installment;
      $pay['frac_month_inst'] = ($loan_account_details[0]->loan_amount - $pay['int_month_inst']*12);
      /*******************************************fraction issue*****************************************/
      // dd($pay);
      $pf_deposits = DB::table('pf_deposit')
                      ->orderBy('deposit_date', 'desc')
                      ->where('staff_code', $staff_code)
                      ->get();

        return view('loan.loan_details',compact('accounts',
         'loan_account_details','pf_deposits','total_and_maximum_pf','loan_adjustments','pay'));
    }

    public function saveLoanInstallment(Request $request)
    {
        $staff_code = $request->staff_code;
        $employees = DB::table('employees')->where('staff_code',$staff_code)->get();

        // print_r($request->all());exit();
        $transaction = new Transaction;
        $transaction->account_head_id = $request->account_head_for_monthly_installment;
        $transaction->description = $staff_code.' '.$employees[0]->first_name.' '.$employees[0]->last_name.' monthly loan installment without interest' ;
        $transaction->amount = $request->monthly_installment;
        $transaction->transaction_date = date('Y-m-d H:i:s', strtotime($request->date_of_adjusment));
        // print_r($transaction->transaction_date);die();
        $transaction->save();

        $transaction = new Transaction;
        $transaction->account_head_id = $request->account_head_for_monthly_interest;
        $transaction->description = $staff_code.' '.$employees[0]->first_name.' '.$employees[0]->last_name.' monthly loan interest' ;
        $transaction->amount = $request->monthly_interest;
        $transaction->transaction_date = date('Y-m-d H:i:s', strtotime($request->date_of_adjusment));
        $transaction->save();

        DB::select('update loan_installment set payment_type="paid" where id='.$request->installment_id);

        return back()->with('success','Your monthly loan installment is successfully paid!.');
    }

}
