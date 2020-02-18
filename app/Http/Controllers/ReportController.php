<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function show_provident_fund_report()
    {     
        $provident_funds = DB::table('pf_deposit')->get();
        return view('report.show_provident_fund_report',compact('provident_funds'));
    }
}
