<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\Pf_interestsImport;
use App\Exports\InterestsExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Interest;

class PFInterestController extends Controller
{
     // PF interest add all update delete
     public function add_pf_interest()
     {
       $employees = DB::table('employees')->get();
       return view('pf_interest.add_pf_interest',compact('employees'));
     }

     public function all_pf_interest()
     {
       $all_pf_interests = Interest::get();
       return view('pf_interest.all_pf_interest',compact('all_pf_interests'));
     }

     public function save_pf_interest(Request $request)
     {
           $this->validate($request,[
             'interest_date'   =>'required',
             'interest_source' =>'required',
             'staff_code'      =>'required',
             'own' =>'required',
             'organization' =>'required',
           ]);

           $pf_interests = new Interest;
           $pf_interests->interest_date = $request->interest_date;
           $pf_interests->interest_source = $request->interest_source;
           $pf_interests->staff_code = $request->staff_code;
           $pf_interests->own = $request->own;
           $pf_interests->organization = $request->organization;
           $pf_interests->save();

           return redirect()->back()->with('success','PF interest added successfully.');
     }

     public function save_pf_interest_batch_upload(Request $request)
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
      $result = Excel::toArray(new Pf_interestsImport, $upload);

    foreach ($result as $key => $value) {
      foreach ($value as $row) {

        try {
            $insert_data[] =array(
                'interest_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
                'interest_source' =>$row[2],
                'staff_code' =>$row[0],
                'own' =>$row[3],
                'organization' =>$row[4],
                );
           }
        catch (\Exception $e) {
            return redirect()->back()->with('error','Somthing went wrong!');
        }
      }
   }
    // dd($insert_data);
    // exit;


      if (!empty($insert_data)) {
          DB::table('interests')->insert($insert_data);
          return back()->with('success','PF Interest batch import successfully');
      }
     }
    }

     public function edit_pf_interest($id)
     {
       $employees = DB::table('employees')->get();
       $pf_interest = Interest::find($id);
       return view('pf_interest.edit_pf_interest',compact('pf_interest','employees'));
     }

     public function update_pf_interest(Request $request,$id)
     {
           $this->validate($request,[
             'interest_date'   =>'required',
             'interest_source' =>'required',
             'staff_code'      =>'required',
             'own' =>'required',
             'organization' =>'required',
           ]);

           $pf_interests = Interest::find($id);
           $pf_interests->interest_date = $request->interest_date;
           $pf_interests->interest_source = $request->interest_source;
           $pf_interests->staff_code = $request->staff_code;
           $pf_interests->own = $request->own;
           $pf_interests->organization = $request->organization;
           $pf_interests->save();


           return redirect()->route('all-pf-interest')->with('success','PF interest updated successfully.');
     }

     public function delete_pf_interest($id)
     {
      $pf_interest = Interest::find($id);
      $pf_interest->delete();
      return redirect()->back()->with('danger','PF interest deleted successfully');
     }
     public function export(){
        return Excel::download(new InterestsExport, 'interests.csv');
      }

}
