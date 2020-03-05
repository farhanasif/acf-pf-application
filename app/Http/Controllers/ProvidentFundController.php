<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provident;
use App\Imports\ProvidentsImport;
use App\Imports\Pf_withdrawsImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Pf_withdraw;
use App\Interest;
use Auth;
use DB;

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
   DB::table('pf_deposit')->where('id',$id)->update($data);
   return back()->with('success', 'Provident Fund Updated Successfully.');

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
                'staff_code' =>$row[0],
                // 'deposit_date' =>\Carbon\Carbon::createFromFormat('m/d/Y', $row['1']),
                'deposit_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
                'own_pf' =>$row[2],
                'organization_pf' =>$row[3],
                'total_pf' =>$row[4],
            );
        }
     }
        if (!empty($insert_data)) {
            DB::table('pf_deposit')->insert($insert_data);
        }
          return back()->with('success','Provident batch import successfully');
      }
  
    }

    // PF add all update delete
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

    public function save_pf_batch_upload(Request $request)
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
      $result = Excel::toArray(new Pf_withdrawsImport, $upload);
      
    foreach ($result as $key => $value) {
      foreach ($value as $row) {
          
            $result = DB::table('pf_withdraws')->where('staff_code',$row[0])->first();
              if(!empty($result))
              {

                $update_data[] =array(
                  'staff_code' =>$row[0],
                  'received_amount' =>$row[3],
                  'received_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
                  'received_by' =>Auth::user()->id,
                  'received_in' =>$row[2],
                  'authorization_signatory' =>Auth::user()->id,
                  'description' =>Auth::user()->id,
                  );
              }
              else{
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
           
          // $insert_data[] = [];
          // $insert_data[] ['staff_code'] = $row[0];
          // $insert_data ['received_amount'] = $row[3];
          // $insert_data ['received_date'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]);
          // $insert_data ['received_by'] = Auth::user()->id;
          // $insert_data ['received_in'] = $row[2];
          // $insert_data ['authorization_signatory'] = Auth::user()->id;
          // $insert_data ['description'] = Auth::user()->id;
      }
   }

  //  print_r($insert_data);
  //  exit;

      if (!empty($insert_data)) {
          DB::table('pf_withdraws')->insert($insert_data);
          return back()->with('success','PF Withdraws batch import successfully');
      }

      if (!empty($update_data)) {
        DB::table('pf_withdraws')->update($update_data);
        return back()->with('success','PF Withdraws batch updated successfully');
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
}
