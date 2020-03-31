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
	       $loan->$staff_code = $request->staff_code;
	       $loan->monthly_installment = $request->monthly_installment;
	       $loan->loan_amount = $request->loan_amount;
	       $loan->total_months =  12;
	       $loan->monthly_interest = $request->monthly_interest;
	       $loan->interest  = $request->interest;
	       $loan->description  = $request->purpose;
	       $loan->issue_date = date('Y-m-d', strtotime($request->date));
	       $loan->save();


	       for($i = 1; $i <= 12; $i++){
   		       $loanInstallment = new LoanInstallment;
		       $loanInstallment->staff_code = $request->staff_code;
		       $loanInstallment->payment_type =  "Due";
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
}
