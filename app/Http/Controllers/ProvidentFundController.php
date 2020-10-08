<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Provident;
use App\ProvidentFundChange;
use App\Imports\ProvidentsImport;
use App\Imports\Pf_withdrawsImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use mysql_xdevapi\Exception;
use Yajra\DataTables\Facades\DataTables;
use App\User;
use App\Pf_withdraw;
use App\Interest;
use Auth;
use DB;
use App\Exports\ProvidentFundsExport;

class ProvidentFundController extends Controller
{

    // public function __construct()
    //   {
    //       $this->middleware('auth');
    //   }

    public function add_provident_fund()
    {

      $provident_funds = DB::table('employees')->get();
      return view('provident_fund.add_provident_fund',compact('provident_funds'));
    }

    public function save_provident_fund(Request $request)
    {
       $this->validate($request,[
        'deposit_date'      =>'required',
        'staff_code'      =>'required',
        'own_pf'          =>'required',
        'organization_pf' =>'required'
       ]);

    $data = array();
    $data['deposit_date'] = $request->deposit_date;
    $data['staff_code'] = $request->staff_code;
    $data['own_pf'] = $request->own_pf;
    $data['organization_pf'] = $request->organization_pf;
    $data['total_pf'] = $request->own_pf+$request->organization_pf;
    $data['created_by'] = Auth::user()->id;
    $data['updated_by'] =  Auth::user()->id;

    // $provident_fund = new Provident;
    // $provident_fund->deposit_date = date("Y-m-d");
    // $provident_fund->staff_code = $request->staff_code;
    // $provident_fund->own_pf = $request->own_pf;
    // $provident_fund->organization_pf = $request->organization_pf;
    // $provident_fund->total_pf = $request->own_pf+$request->organization_pf;
    // $provident_fund->created_by = Auth::user()->id;
    // $provident_fund->updated_by =  Auth::user()->id;
    // $provident_fund->save();

    $provident_fund = DB::table('pf_deposit')->insert($data);
    return back()->with('success', 'Provident Fund Added Successfully.');
    }

    public function all_provident_fund(Request $request)
    {

        $query = "select * from pf_deposit";

        $data['provident_funds'] = DB::table('pf_deposit')->orderBy('deposit_date','ASC')->get();

        $data['deposit_dates'] = DB::select("SELECT deposit_date,  DATE_FORMAT(deposit_date, '%b %Y') AS month_name
      FROM pf_deposit
      GROUP BY month_name
      ORDER BY deposit_date");

         //dd($data['deposit_dates']);

        $data['staff_codes'] = DB::select("SELECT DISTINCT(staff_code) AS staff_code FROM pf_deposit");

         //dd($data['staff_codes']);

        if ($request->isMethod('post')) {

            $staff_code = $request->staff_code;
            $deposit_date = $request->deposit_date;

            if($staff_code == '-1' && $deposit_date == '-1'){
            }
            else{
                $query = $query. " where 1=1 ";

                if($staff_code != '-1'){
                    $query = $query . " AND staff_code = '".$staff_code."'";
                }

                if($deposit_date != '-1'){
                    $query = $query . " AND deposit_date = '".$deposit_date."'";
                }

            }
            $data['provident_funds'] = DB::select($query);
            return view('provident_fund.all_provident_fund',$data);
        }
        else{

            $data['provident_funds'] = DB::select($query);
            return view('provident_fund.all_provident_fund',$data);
        }
    }

    public function edit_provident_fund($id)
    {
      $all_employees = Employee::all();
      $provident_fund = DB::table('pf_deposit')->where('id',$id)->first();
      return view('provident_fund.edit_provident_fund',compact('provident_fund','all_employees'));
    }

    public function update_provident_fund(Request $request, $id)
    {
//        dd($request->all());
      $this->validate($request,[
             'staff_code'      =>'required',
             'own_pf'          =>'required',
             'organization_pf' =>'required'
      ]);

    try {
        $data = new ProvidentFundChange();
        $data->deposit_date = $request->deposit_date;
        $data->staff_code = $request->staff_code;
        $data->old_own_pf = $request->old_own_pf;
        $data->old_organization_pf = $request->old_organization_pf;
        $data->old_total_pf = $request->old_own_pf + $request->old_organization_pf;
        $data->own_pf = $request->own_pf;
        $data->organisation_pf = $request->organization_pf;
        $data->total_pf = $request->own_pf + $request->organization_pf;
        $data->status = 0;
        $data->created_by = Auth::user()->id;
        $data->updated_by =  Auth::user()->id;
        $data->save();
        return back()->with('success', 'Change Provident Fund data inserted Successfully.');
    }catch(\Exception $e){
        return back()->with('danger', 'Change Provident Fund not inserted. try again! something is wrong here...');
    }

    }

    //All approved deposite
    public function allApprovedPfDeposite(Request $request){
        $query = "select * from pf_deposit";
        $data['deposit_dates'] = DB::select("SELECT deposit_date,  DATE_FORMAT(deposit_date, '%b %Y') AS month_name
        FROM pf_deposit
        GROUP BY month_name
        ORDER BY deposit_date");

        // dd($data['deposit_dates']);

        $data['staff_codes'] = DB::select("SELECT DISTINCT(staff_code) AS staff_code FROM pf_deposit");

        // dd($data['staff_codes']);

        if ($request->isMethod('post')) {

            $staff_code = $request->staff_code;
            $deposit_date = $request->deposit_date;

            if($staff_code == '-1' && $deposit_date == '-1'){
            }
            else{
                $query = $query. " where 1=1 ";

                if($staff_code != '-1'){
                    $query = $query . " AND staff_code = '".$staff_code."'";
                }

                if($deposit_date != '-1'){
                    $query = $query . " AND deposit_date = '".$deposit_date."'";
                }

            }
            $data['provident_funds'] = DB::select($query);

            //dd($data);
            return view('provident_fund.approved-list',$data);
        }
        else{
//            $data['provident_funds'] = DB::table('pf_deposit')
//                ->select('pf_deposit.*','pf_deposit_change.own_pf as change_own_pf',
//                    'pf_deposit_change.organisation_pf as change_organisation_pf',
//                    'pf_deposit_change.total_pf as change_total_pf',
//                    'pf_deposit_change.status as change_status')
//                ->leftJoin('pf_deposit_change','pf_deposit_change.staff_code','=','pf_deposit.staff_code')
//                ->orderBy('deposit_date','DESC')
//                ->get();

            $data['provident_funds'] = DB::table('pf_deposit_change')->get();
            return view('provident_fund.approved-list',$data);
        }
        //return view('provident_fund.approved-list');
    }

    public function activateAll(Request $request)
    {
            $ids = $request->deposite_ids;
            //return $ids;
            foreach ($ids as $id) {
                $provident_funds = ProvidentFundChange::
//                    ->select('pf_deposit.*','pf_deposit_change.own_pf as change_own_pf',
//                        'pf_deposit_change.organisation_pf as change_organisation_pf',
//                        'pf_deposit_change.total_pf as change_total_pf',
//                        'pf_deposit_change.status as change_status')
//                    ->leftJoin('pf_deposit_change','pf_deposit_change.staff_code','=','pf_deposit.staff_code')
//                    ->orderBy('deposit_date','DESC')
                    find($id);
                //dd($provident_funds);
                //$question = Question::find($id);
                if ($provident_funds) {
                    $provident_funds->status=1;
                    $provident_funds->save();
                }
            }
            return response()->json('success', 201);
    }

    public function deactivateAll(Request $request){
            $ids = $request->deposite_ids;
            foreach ($ids as $id) {
                $provident_funds = ProvidentFundChange::
//                    ->select('pf_deposit.*','pf_deposit_change.own_pf as change_own_pf',
//                        'pf_deposit_change.organisation_pf as change_organisation_pf',
//                        'pf_deposit_change.total_pf as change_total_pf',
//                        'pf_deposit_change.status as change_status')
//                    ->leftJoin('pf_deposit_change','pf_deposit_change.staff_code','=','pf_deposit.staff_code')
//                    ->orderBy('deposit_date','DESC')
                    find($id);
                //$question = Question::find($id);
                if ($provident_funds) {
                    $provident_funds->status=0;
                    $provident_funds->save();
                }
            }
            return response()->json('success', 201);
    }

    public function deleteAll(Request $request){
        $ids = $request->deposite_ids;
        foreach ($ids as $id){
            $provident_funds = ProvidentFundChange::
//                    ->select('pf_deposit.*','pf_deposit_change.own_pf as change_own_pf',
//                        'pf_deposit_change.organisation_pf as change_organisation_pf',
//                        'pf_deposit_change.total_pf as change_total_pf',
//                        'pf_deposit_change.status as change_status')
//                    ->leftJoin('pf_deposit_change','pf_deposit_change.staff_code','=','pf_deposit.staff_code')
//                    ->orderBy('deposit_date','DESC')
            find($id);
            if ($provident_funds){
                $provident_funds->delete();
            }
        }
        return response()->json('success',201);
    }

    public function delete($id){
        $provident_funds = ProvidentFundChange::
//                    ->select('pf_deposit.*','pf_deposit_change.own_pf as change_own_pf',
//                        'pf_deposit_change.organisation_pf as change_organisation_pf',
//                        'pf_deposit_change.total_pf as change_total_pf',
//                        'pf_deposit_change.status as change_status')
//                    ->leftJoin('pf_deposit_change','pf_deposit_change.staff_code','=','pf_deposit.staff_code')
//                    ->orderBy('deposit_date','DESC')
                   find($id);
        if ($provident_funds){
            $provident_funds->delete();
            return response()->json('success',201);
        }
        return response()->json('error',422);
    }

    public function show_provident_fund_batch_upload()
    {
      return view('provident_fund.show_provident_fund_batch_upload');
    }

    public function providentFund(){
      return view('report.pfreport');
     }

     public function getProvidentFund()
     {
        // $from = $request->from_date;
        // echo $from;
        // exit;
      $results = DB::select('select pf.*,  e.`basic_salary`, e.`gross_salary`, date_format(pf.`created_at`, "%Y%m") as PaymentMonth, e.`first_name`, e.`last_name`, e.`category`, e.`level`, e.`joining_date`, e.`ending_date`, e.`work_place`
      from `pf_deposit` as pf
      inner join `employees` as e
      on pf.`staff_code` = e.`staff_code`');

      return json_encode($results);
     }

    public function save_pf_deposit_batch(Request $request)
    {
        $upload = $request->file('file');
        $filename = $_FILES['file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $accept_files = ["csv", "txt", "xlsx"];
        if(!in_array($ext, $accept_files)) {
            return redirect()->back()
            ->with('error', 'Invalid file extension. permitted file is .csv & .xlsx');
        }
        // get the file
        $upload = $request->file('file');
        $filePath = $upload->getRealPath();

        if($ext == "xlsx" || $ext == "csv") {
        // $result = Excel::import(new ProvidentsImport, $upload);
        $result = Excel::toArray(new ProvidentsImport, $upload);

        $all_employees_staff_code = DB::select('SELECT staff_code FROM employees');
        $employee_code = [];
        foreach($all_employees_staff_code as $employee_staff_code){
          $employee_code[] = $employee_staff_code->staff_code;
        }

        foreach ($result[0] as $key=> $row) {

                $insert_data[$key] =array(
                'staff_code' =>(int)$row[0],
                // 'deposit_date' =>\Carbon\Carbon::createFromFormat('m/d/Y', $row['1']),
                'deposit_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
                'own_pf' =>$row[2],
                'organization_pf' =>$row[3],
                'total_pf' =>$row[4],
            );

            if (!in_array($insert_data[$key]['staff_code'], $employee_code) ) {
              unset($insert_data[$key]);
            }
        }

          if (!empty($insert_data)) {
            DB::table('pf_deposit')->insert($insert_data);
            return back()->with('success','Provident batch import successfully');
        }
        else{
          return back()->with('error','Provident batch empty');
        }

      }

    }

    public function export()
    {
        return Excel::download(new ProvidentFundsExport, 'provident-fund-deposit.csv');
    }
}
