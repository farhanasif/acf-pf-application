<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LedgerReportController extends Controller
{
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

        //dd($months);

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

   public function view_ledger_report()
   {
    $lreport = DB::select("SELECT DISTINCT(DATE(deposit_date)) AS deposit_date, DATE_FORMAT(deposit_date, '%b %Y') AS month_name
                            FROM pf_deposit
                            ORDER BY deposit_date");

        //    dd($lreport);
        //    exit;
        return view('report.ledger',compact('lreport'));
    }


    public function view_ledger_report_test(){
        return view('report.ledgeruitest');
    }


}