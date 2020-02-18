<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provident;
use App\Imports\ProvidentsImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Auth;
use DB;

class ProvidentFundController extends Controller
{
    public function add_provident_fund()
    {
      return view('provident_fund.add_provident_fund');
    }

    public function save_provident_fund(Request $request)
    {
      //  $this->validate($request,[
      //         'staff_code'      =>'required',
      //         'own_pf'          =>'required',
      //         'organization_pf' =>'required'
      //  ]);

    $data = array();
    $data['deposit_date'] = date("Y-m-d");
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

    public function all_provident_fund()
    {
      $provident_funds = DB::table('pf_deposit')->get();
      return view('provident_fund.all_provident_fund',compact('provident_funds'));
    }

    public function edit_provident_fund($id)
    {
      $provident_fund = DB::table('pf_deposit')->where('id',$id)->first();
      return view('provident_fund.edit_provident_fund',compact('provident_fund'));
    }

    public function update_provident_fund(Request $request, $id)
    {
      $this->validate($request,[
             'staff_code'      =>'required',
             'own_pf'          =>'required',
             'organization_pf' =>'required'
      ]);

   $data = array();
   $data['deposit_date'] = date("Y-m-d");
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
   DB::table('pf_deposit')->where('id',$id)->update($data);
   return back()->with('success', 'Provident Fund Updated Successfully.');

    }

    public function show_provident_fund_batch_upload()
    {
      return view('provident_fund.show_provident_fund_batch_upload');
    }


    public function save_provident_fund_batch_upload(Request $request)
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
        // $result = Excel::import(new ProvidentsImport, $upload);
        $result = Excel::toArray(new ProvidentsImport, $upload);
      foreach ($result as $key => $value) {
        foreach ($value as $row) {

                $insert_data[] =array(
                'deposit_date' =>date("Y-m-d"),
                'staff_code' =>$row[0],
                'own_pf' =>$row[1],
                'organization_pf' =>$row[2],
                'total_pf' =>$row[3],
            );
        }
    }
    if (!empty($insert_data)) {
        DB::table('pf_deposit')->insert($insert_data);
    }
    return back()->with('success','Provident batch import successfully');
  }
  
}
  
    //  return back()->with('success','Provident batch import successfully');
    // }
}
