<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Employee;
use Auth;

class SettlementController extends Controller
{
    public function checkExpireStaffSettlement(Request $request)
    {
      $staff_code = $request->staff;

      $settlement_date = date('Y-m-d', strtotime($request->settlement_date));

      // dd($settlement_date);      

      $employee_expire_date = Employee::where('staff_code',$staff_code)->first()->settlement_date;
      if($employee_expire_date){
        return response()->json(['expire_date'=>$employee_expire_date]);
      }
      else{
        return response()->json(['expire_date'=>'0']);
      }

    }

    public function expireStaffSettlementUpdate(Request $request)
    {
      // dd($request->all());
      $staff_code = $request->staff;
      $settlement_date_update = date('Y-m-d', strtotime($request->settlement_date));


      // $total_pf_deposits = DB::select("SELECT pf_deposit.*, sum(total_pf) AS total_provident_fund
      //                                   FROM pf_deposit
      //                                   WHERE staff_code = ".$staff_code);

// dd($total_pf_deposits);

      // $total_interest = DB::select("SELECT sum(interests.own) as own_interest, sum(interests.organization) as org_interest
      //                                   FROM interests
      //                                   WHERE staff_code ='".$staff_code."' AND interest_date <= '".$settlement_date_update."' ");

// dd($total_interest);
      // $total_settlement_amount = $total_pf_deposits[0]->total_provident_fund + ($total_interest[0]->own_interest + $total_interest[0]->org_interest);

                        DB::table('pf_settlement')->insert(
                          ['staff_code'=>$staff_code,
                           'settlement_date'=>$settlement_date_update,
                           'settlement_amount'=>$request->settlement_amount,
                           'is_settlement' => 1,
                           'created_by' =>Auth::user()->id
                          ]);

      $employee_expire_date_update = Employee::where('staff_code',$staff_code)->update(['settlement_date'=>$settlement_date_update, 'is_settlement' => 1]);
      return response()->json(['status'=>$employee_expire_date_update]);
      
    }
}

