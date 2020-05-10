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
        $work_position = $_GET['work_position'];
        $work_department = $_GET['work_department'];
        $work_sublocation = $_GET['work_sublocation'];
        $work_category = $_GET['work_category'];
        $work_level = $_GET['work_level'];
        $work_place = $_GET['work_place'];
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
                $query = $query."
                    ,SUM(pd.".$month->month_name."_own) `".$month->month_name." own`
                    ,SUM(pd.".$month->month_name."_organization) `".$month->month_name." organization`
                    ,SUM(pd.".$month->month_name.") ".$month->month_name."";
                $total_query = $total_query."pd.".$month->month_name."+";

                $sub_query = $sub_query.",
                SUM(
                    CASE
                        WHEN date(p.`deposit_date`) = '".$month->deposit_date."'
                        THEN p.`own_pf`
                        ELSE 0
                    END
                ) AS '".$month->month_name."_own',
                SUM(
                    CASE
                        WHEN date(p.`deposit_date`) = '".$month->deposit_date."'
                        THEN p.`organization_pf`
                        ELSE 0
                    END
                ) AS '".$month->month_name."_organization',
                SUM(
                    CASE
                        WHEN date(p.`deposit_date`) = '".$month->deposit_date."'
                        THEN p.`total_pf`
                        ELSE 0
                    END
                ) AS '".$month->month_name."' ";

            }


            $where_query = 'WHERE 1=1 ';

            if($work_position == '-1' || $work_position == ''){}
            else{
                $where_query = $where_query." AND e.`position` = '".$work_position."'";
            }

            if($work_department == '-1' || $work_department == ''){}
            else{
                $where_query = $where_query." AND e.`department_code` = '".$work_department."'";
            }

            if($work_sublocation == '-1' || $work_sublocation == ''){}
            else{
                $work_sublocation = str_replace("'","\'",$work_sublocation);
                $where_query = $where_query." AND e.`sub_location` = '".$work_sublocation."'";
            }

            if($work_category == '-1' || $work_category == ''){}
            else{
                $where_query = $where_query." AND e.`category` = '".$work_category."'";
            }

            if($work_level == '-1' || $work_level == ''){}
            else{
                $where_query = $where_query." AND e.`level` = '".$work_level."'";
            }

            if($work_place == '-1' || $work_place == ''){}
            else{
                $work_place = str_replace("'","\'",$work_place);
                $where_query = $where_query." AND e.`work_place` = '".$work_place."'";
            }

            //finish the subquery
            $sub_query = $sub_query." FROM `pf_deposit` as p
            INNER JOIN employees as e
            ON p.`staff_code` = e.`staff_code` ".$where_query."
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
        $data['lreport'] = DB::select("SELECT DISTINCT(DATE(deposit_date)) AS deposit_date, DATE_FORMAT(deposit_date, '%b %Y') AS month_name
                                FROM pf_deposit
                                ORDER BY deposit_date");
        $data['positions'] = DB::table('positions')->get();
        $data['departments'] = DB::table('departments')->get();
        $data['subLocations'] = DB::table('sub_locations')->get();
        $data['categories'] = DB::table('categories')->get();
        $data['levels'] = DB::table('levels')->get();
        $data['work_places'] = DB::table('work_places')->get();

        return view('report.ledger',$data);
    }


    public function view_ledger_report_test(){
        return view('report.ledgeruitest');
    }


}
