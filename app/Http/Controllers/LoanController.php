<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Loan;
use App\LoanInstallment;
use App\Transaction;


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
	       $transaction->save();


	       echo("Loan application submitted successfully!");
	       return;
	   }catch(Exception $e){
            DB::rollback();
            echo $e;
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
}
