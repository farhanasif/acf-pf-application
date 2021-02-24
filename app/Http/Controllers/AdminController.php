<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function admin_home(){

        $data['total_investments'] = DB::select("SELECT SUM(amount) AS total_investment_amount
                                        FROM transactions
                                        WHERE transactions.account_head_id = 12112");


    //  dd($data['total_investments']);
    //  exit;

        $data['total_balance_in_account_from_pf_deposit'] = DB::table('pf_deposit')->sum('total_pf');
        $data['total_balance_in_account_from_transaction'] = DB::table('transactions')->sum('amount');

        $data['total_balance'] = DB::select("SELECT SUM(t.amount) AS total_amount FROM (SELECT SUM(total_pf) AS amount FROM pf_deposit UNION SELECT SUM(amount) AS amount FROM transactions) AS t");



        // dd($data['total_balance_in_account_from_transaction']);

        $data['total_employees'] = DB::table("employees")->count('staff_code');
        $data['total_active_employees'] = DB::table("employees")->where('ending_date',null)->count('staff_code');
        
        $data['total_loans'] = DB::select('SELECT COUNT(DISTINCT staff_code) AS total_loan, SUM(loan_amount) AS total_loan_amount FROM loans');

        // $contribution = DB::select('select sum(own_pf) as employer_contribution, sum(organization_pf) as employee_contribution from pf_deposit');

        $data['employer_contribution'] = DB::table('pf_deposit')->sum('own_pf');
        $data['employee_contribution'] = DB::table('pf_deposit')->sum('organization_pf');

        $data['total_pf_from_pf_deposit'] = DB::table('pf_deposit')->sum('total_pf');
        $data['sum_from_transaction'] = DB::table('transactions')->sum('amount');

        // dd($data['sum_from_transaction']);
        // exit;

        $data['total_employee_under_loan'] = DB::select('SELECT COUNT(DISTINCT staff_code) AS total_pf_staff FROM pf_deposit;');
    	return view('admin_home',$data);
    }

    public function user_home(){

    	return view('user_home');
    }

    // public function change_profile()
    // {
    //     return view('change_profile');
    // }
    /***************************************** sonali payment gatway*********************************/
        public function getSonaliBankApiToken(Request $request)
    {
        $data = $request->all();

        $payer_id = $this->genarateUniqueStringKey('abcdefghijklmnopqrstuvwxyz');
        $number = rand(1000000,9999999); 
        //echo $_POST['txtName'];
        $reqId="025".str_pad($number,7,"0");
        // $data["AccessUser"] = ["userName: bdtaxUser2014",
        //          "password: duUserPayment2014"];
        $get_token_data = $data['get_token_data'];
        $pyment_session_token_data = $data['pyment_session_token_data'];

        $get_token_data['strRequestId'] = $reqId;
        $get_token_data = json_encode($get_token_data);
        $date2 = date("Y-m-d");
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://27.147.153.82:6314/api/SpgService/GetSessionKey",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_SSL_VERIFYPEER=> false,
          CURLOPT_SSL_VERIFYHOST=> false,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $get_token_data,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $scretKeys = json_decode($response);
        $scretKeys = json_decode($scretKeys);
        $scretKey = $scretKeys->scretKey;
        // dd($scretKey);
        $pyment_session_token_data['Authentication']['ApiAccessPassKey'] = $scretKey;
        $pyment_session_token_data['ReferenceInfo']['RequestId'] = $reqId;
        $pyment_session_token_data['ReferenceInfo']['RefTranNo'] = $number;
        $pyment_session_token_data['ReferenceInfo']['PayerId'] = $payer_id;
        $pyment_session_token_data = json_encode($pyment_session_token_data);
        // dd($pyment_session_token_data);
        $session_token = $this->getSonaliBankPymentSessionToken($pyment_session_token_data);
        $session_token = json_decode($session_token,true);
        $session_token = json_decode($session_token,true);
        $session_token = $session_token["session_token"];

        // $result = $this->redirectPat($session_token);
        // dd($result);
        // dd($session_token);
        return $session_token;
    }

    public function getSonaliBankPymentSessionToken($data)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://27.147.153.82:6314/api/SpgService/PaymentByPortal",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_SSL_VERIFYPEER=> false,
          CURLOPT_SSL_VERIFYHOST=> false,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $data,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //$session_token = json_encode($response);
        return $response;
    }
    
        
 
    function genarateUniqueStringKey($input,$strength = 3) {
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
        return $random_string;
    }


    public function sonaliIndex(Request $reuest)
    {
        return view('sonali_create');
    }
}
