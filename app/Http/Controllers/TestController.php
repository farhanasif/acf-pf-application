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
}
