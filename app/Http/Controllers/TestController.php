<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExport()
    {
        return view('fileupload');
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        $array = Excel::toArray(new UsersImport, request()->file('file'));
        dd($array);

        return back();
    }

    public function getEmlpoyees(Request $request){
        
        $query = "Select * from employees";
        $positions = DB::table('positions')->get();
        $categories = DB::table('categories')->get();

        if ($request->isMethod('post')) {
            $position = $request->position;
            $category = $request->category;

            if($category == '-1' && $position == '-1'){
            }
            else{
                $query = $query. " where 1=1 ";
                
                if($position != '-1'){
                    $query = $query . " AND position = '".$position."'";
                }

                if($category != '-1'){
                    $query = $query . " AND category = '".$category."'";
                }

            }

            $query = $query." limit 10";
            //dd($query);
            $employees = DB::select($query);
            return view('viewEmployees',compact('employees','positions','categories'));
        }
        else{

            $query = $query." limit 10";
            $employees = DB::select($query);
            return view('viewEmployees',compact('employees','positions','categories'));
        }

        
    }

    public function providentFund(){
        return view('pfreport');
    }

    public function getProvidentFund(){
        $results = DB::select('select pf.*,  e.`basic_salary`, e.`gross_salary`, date_format(pf.`created_at`, "%Y%m") as PaymentMonth, e.`first_name`, e.`last_name`, e.`category`, e.`level`, e.`joining_date`, e.`ending_date`, e.`work_place`
        from `pf_deposit` as pf
        inner join `employees` as e
        on pf.`staff_code` = e.`staff_code`');

        return json_encode($results);
    }

    public function ledger_report(){
        //fixed date for now
        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];
        //get all the months required
        $months = DB::select('select distinct(date(deposit_date)) as deposit_date, date_format(deposit_date, \'%b_%Y\') as month_name
        from pf_deposit
        where date(deposit_date) between \''.$from_date.'\' and \''.$to_date.'\' order by deposit_date');

        //count months
        $total_months = count($months);

        //if months > 0 , then proceed
        if($total_months > 0){
            //generte the master query
            $query = "SELECT coalesce(pd.`staff_code`, 'Total') staff_code,
            pd.employee_name,
            pd.category,
            pd.level,
            pd.base";
            $total_query = ",SUM(";
            $sub_query = "SELECT p.`staff_code`, CONCAT(e.first_name,' ', e.last_name) as employee_name, e.category, e.level, e.base";


            foreach($months as $month){
                $query = $query.",SUM(pd.".$month->month_name.") ".$month->month_name."";
                $total_query = $total_query."pd.".$month->month_name."+";

                $sub_query = $sub_query.", SUM(
                    CASE
                        WHEN date(p.`deposit_date`) = '".$month->deposit_date."'
                        THEN p.`total_pf`
                        ELSE 0
                    END
                ) AS '".$month->month_name."' ";

            }

            //finish the subquery
            $sub_query = $sub_query." FROM `pf_deposit` as p
            INNER JOIN employees as e
            ON p.`staff_code` = e.`staff_code`
            GROUP BY p.`staff_code`, e.first_name, e.last_name, e.category, e.level, e.base
            ORDER BY p.`staff_code`";

            //finish total calculation
            $total_query = rtrim($total_query, '+');
            $total_query = $total_query.") Total";

            $master_query = $query.$total_query."
            FROM(
            ".$sub_query."
            ) as pd
            group by staff_code with rollup
            ";

            //return $master_query;

            $results = DB::select($master_query);
            //return count($results);
            return json_encode($results);
        }

        //return json_encode($months);
    }

    function view_ledger_report(){
        return view('ledger');
    }
}
