<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function admin_home(){

        $data['total_investments'] = DB::select("SELECT SUM(amount) AS total_investment_amount
                                        FROM transactions
                                        WHERE transactions.account_head_id = 12112");

    //  dd($data['total_investments']);
    //  exit;

        $data['total_balance_in_account_from_pf_deposit'] = DB::table('pf_deposit')->sum('total_pf');
        $data['total_balance_in_account_from_transaction'] = DB::table('transactions')->sum('amount');

        $data['total_employees'] = DB::table("employees")->count('staff_code');
        $data['total_loans'] = DB::select('SELECT COUNT(DISTINCT staff_code) AS total_loan, SUM(loan_amount) AS total_loan_amount FROM loans');

        // $contribution = DB::select('select sum(own_pf) as employer_contribution, sum(organization_pf) as employee_contribution from pf_deposit');

        $data['employer_contribution'] = DB::table('pf_deposit')->sum('own_pf');
        $data['employee_contribution'] = DB::table('pf_deposit')->sum('organization_pf');

        $data['total_employee_under_loan'] = DB::select('SELECT COUNT(DISTINCT staff_code) AS total_pf_staff FROM pf_deposit;');
    	return view('admin_home',$data);
    }

    public function user_home(){

    	return view('user_home');
    }

    // public function change_profile()
    // {
    //     return view('change_profile');
    // }

}
