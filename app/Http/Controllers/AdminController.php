<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    public function admin_home(){

        $total_employees = DB::table("employees")->count('staff_code');

        // $contribution = DB::select('select sum(own_pf) as employer_contribution, sum(organization_pf) as employee_contribution from pf_deposit');
        
        $employer_contribution = DB::table('pf_deposit')->sum('own_pf');
        $employee_contribution = DB::table('pf_deposit')->sum('organization_pf');
    	return view('admin_home',compact('total_employees','employee_contribution','employer_contribution'));
    }

    public function user_home(){

    	return view('user_home');
    }

    public function change_profile()
    {
        return view('change_profile');
    }

}
