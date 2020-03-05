<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\Pf_withdrawsImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Pf_withdraw;
use Auth;
use DB;

class PFWithdrawController extends Controller
{
   
    public function add_pf_withdraw()
    {
      $employees = DB::table('employees')->get();
      return view('pf_withdraw.add_pf_withdraw',compact('employees'));
    }

    public function all_pf_withdraw()
    {
      $all_pf_withdraws = Pf_withdraw::get();
      return view('pf_withdraw.all_pf_withdraw',compact('all_pf_withdraws'));
    }

    public function save_pf_withdraw(Request $request)
    {
      $this->validate($request,[
        'staff_code'      =>'required',
        'received_amount' =>'required',
        'received_date' =>'required',
        'received_by' =>'required',
        'received_in' =>'required',
        'authorization_signatory' =>'required',
        'description' =>'required',
      ]);

          $pf_withdraws = new Pf_withdraw;
          $pf_withdraws->staff_code = $request->staff_code;
          $pf_withdraws->received_amount = $request->received_amount;
          $pf_withdraws->received_date = $request->received_date;
          $pf_withdraws->received_by = $request->received_by;
          $pf_withdraws->received_in = $request->received_in;
          $pf_withdraws->authorization_signatory = $request->authorization_signatory;
          $pf_withdraws->description = $request->description;
          $pf_withdraws->created_by = Auth::user()->id;
          $pf_withdraws->updated_by =  Auth::user()->id;
          $pf_withdraws->save();

          return redirect()->back()->with('success','PF withdraw added successfully.');
    }

    public function save_pf_withdraw_batch_upload(Request $request)
    {
      $upload = $request->file('file');
      $filename = $_FILES['file']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $accept_files = ["csv", "txt", "xlsx"];
      if(!in_array($ext, $accept_files)) {
          return redirect()->back()
          ->with('error', 'Invalid file extension. permitted file is .csv, .txt & .xlsx');
      }
      // get the file
      $upload = $request->file('file');
      $filePath = $upload->getRealPath();

      if($ext == "xlsx" || $ext == "csv") {
      // $result = Excel::import(new Pf_withdrawsImport, $upload);
      $result = Excel::toArray(new Pf_withdrawsImport, $upload);
      
    foreach ($result as $key => $value) {
      foreach ($value as $row) {
                $insert_data[] =array(
                  'staff_code' =>$row[0],
                  'received_amount' =>$row[3],
                  'received_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
                  'received_by' =>Auth::user()->id,
                  'received_in' =>$row[2],
                  'authorization_signatory' =>Auth::user()->id,
                  'description' =>Auth::user()->id,
                  );
      }
   }
      if (!empty($insert_data)) {
          DB::table('pf_withdraws')->insert($insert_data);
          return back()->with('success','PF Withdraws batch import successfully');
      }   
    }

    }

    public function edit_pf_withdraw($id)
    {
      $employees = DB::table('employees')->get();
      $pf_withdraw = Pf_withdraw::find($id);
      return view('pf_withdraw.edit_pf_withdraw',compact('pf_withdraw','employees'));
    }

    public function update_pf_withdraw(Request $request,$id)
    {
      $this->validate($request,[
        'staff_code'      =>'required',
        'received_amount' =>'required',
        'received_date' =>'required',
        'received_by' =>'required',
        'received_in' =>'required',
        'authorization_signatory' =>'required',
        'description' =>'required',
      ]);

          $pf_withdraws = Pf_withdraw::find($id);
          $pf_withdraws->staff_code = $request->staff_code;
          $pf_withdraws->received_amount = $request->received_amount;
          $pf_withdraws->received_date = $request->received_date;
          $pf_withdraws->received_by = $request->received_by;
          $pf_withdraws->received_in = $request->received_in;
          $pf_withdraws->authorization_signatory = $request->authorization_signatory;
          $pf_withdraws->description = $request->description;
          $pf_withdraws->created_by = Auth::user()->id;
          $pf_withdraws->updated_by =  Auth::user()->id;
          $pf_withdraws->save();

          return redirect()->route('all-pf-withdraw')->with('success','PF withdraw updated successfully.');
    }

    public function delete_pf_withdraw($id)
    {
     $pf_withdraw = Pf_withdraw::find($id);
     $pf_withdraw->delete();
     return redirect()->back()->with('danger','PF withdraw deleted successfully');
    }
  

}
