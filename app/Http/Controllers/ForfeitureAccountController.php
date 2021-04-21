<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ForfeitureAccount;
use App\Imports\ForfeitureAccountsImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ForfeitureAccountController extends Controller
{
    public function index(Request $request)
    {
        $query = "select * from forfeiture_accounts";

        $data['all_forfeiture_accounts'] = ForfeitureAccount::get();
  
        $data['fa_dates'] = DB::select("SELECT DISTINCT(DATE(fa_date)) AS fa_date,  DATE_FORMAT(fa_date, '%b %Y') AS month_name
        FROM forfeiture_accounts
        GROUP BY month_name
        ORDER BY fa_date");
  
        $data['staff_codes'] = DB::select("SELECT DISTINCT(staff_code) AS staff_code FROM forfeiture_accounts");
  
        if ($request->isMethod('post')) {
  
            $staff_code = $request->staff_code;
            $fa_date = $request->fa_date;
  
            if($staff_code == '-1' && $fa_date == '-1'){
            }
            else{
                $query = $query. " where 1=1 ";
  
                if($staff_code != '-1'){
                  $query = $query . " AND staff_code = '".$staff_code."'";
                }
  
                if($fa_date != '-1'){
                  $query = $query . " AND fa_date = '".$fa_date."'";
                }
  
            }
            $data['all_forfeiture_accounts'] = DB::select($query);
            return view('forfeitureAccount.index',$data);
        }
        else{
  
            $data['all_forfeiture_accounts'] = DB::select($query);
            return view('forfeitureAccount.index',$data);
        }

        return view('forfeitureAccount.index');
    }

    public function create()
    {
        $data['create_edit_routes'] = 'store.forfeiture_accounts';
        $data['employees'] = DB::table('employees')->get();
      return view('forfeitureAccount.form',$data);
    }

    public function store(Request $request)
    {
        // dd(date('Y-m-d', strtotime($request->fa_date)));

          $this->validate($request,[
            'fa_date'   =>'required',
            'fa_source' =>'required',
            'staff_code'      =>'required',
            'own' =>'required',
            'organization' =>'required',
          ]);

          try {
            $forfeitureAccounts = new ForfeitureAccount;
            $forfeitureAccounts->fa_date = date('Y-m-d', strtotime($request->fa_date));
            $forfeitureAccounts->fa_source = $request->fa_source;
            $forfeitureAccounts->staff_code = $request->staff_code;
            $forfeitureAccounts->own = $request->own;
            $forfeitureAccounts->organization = $request->organization;
            if($forfeitureAccounts->save())
            {
                return redirect()->back()->with('success','Forfeiture Account successfully saved.');
            }else{
                return redirect()->back()->with('danger','Somthing Error Found, Please try again.');
            }
          } catch (\Throwable $th) {
              //throw $th;
              return redirect()->back()->with('danger','Somthing Error Found, Please try again.');
          }
    }

    public function edit($id)
    {
        $data['create_edit_routes'] = 'edit.forfeiture_accounts';
        $data['employees'] = DB::table('employees')->get();
        $data['forfeitureAccount'] = ForfeitureAccount::findOrFail($id);
        // dd($data['forfeitureAccount']);
      return view('forfeitureAccount.form',$data);
    }

    public function delete($id)
    {
        try {
            $forfeitureAccount = ForfeitureAccount::findOrFail($id);
            if($forfeitureAccount->delete()){
                return redirect()->back()->with('success','Forfeiture Account successfully deleted.');
            }else {
                return redirect()->back()->with('danger','Somthing Error Found, Please try again.');
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('danger','Somthing Error Found, Please try again.');
        }

     
    }

    public function store_forfeiture_accounts_batch_upload(Request $request)
    {
      $upload = $request->file('file');
      $filename = $_FILES['file']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $accept_files = ["csv", "xlsx"];
      if(!in_array($ext, $accept_files)) {
          return redirect()->back()
          ->with('error', 'Invalid file extension. permitted file is .csv & .xlsx');
      }
      // get the file
      $upload = $request->file('file');
      $filePath = $upload->getRealPath();

      if($ext == "xlsx" || $ext == "csv") {
      // $result = Excel::import(new Pf_interestsImport, $upload);
      $result = Excel::toArray(new ForfeitureAccountsImport, $upload);

      // dd($result);

      $all_employees_staff_code = DB::select('SELECT staff_code FROM employees');
      $employee_code = [];
      foreach($all_employees_staff_code as $employee_staff_code){
        $employee_code[] = $employee_staff_code->staff_code;
      }

    // foreach ($result as $key => $value) {
      foreach ($result[0] as $key => $row) {
            $insert_data[$key] =array(
                'fa_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
                'fa_source' =>$row[2],
                'staff_code' =>(int)$row[0],
                'own' =>$row[3],
                'organization' =>$row[4],
                );

                if (!in_array($insert_data[$key]['staff_code'], $employee_code) ) {
                  unset($insert_data[$key]);
                }
      }
      // dd($insert_data);

  //  }
          if (!empty($insert_data)) {
            DB::table('forfeiture_accounts')->insert($insert_data);
            return back()->with('success','Forfeiture Account batch import successfully');
        }
        else{
          return back()->with('error','Forfeiture Account batch empty');
        }
     }
    }
}
