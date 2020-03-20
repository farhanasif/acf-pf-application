<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class BankController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */

    function view_blank(){
        return view('blank');
    }

    function view_trancaction(){
        return view('transaction');
    }

    function get_monthly_bank_book(){
        $from_date = $_GET['from_date'];
        $from_date = $from_date.' 00:00:00';



        return $from_date;
    }

    function save_monthly_bank_book(){
        
        $transactionDate = $_GET['transactionDate'];
        $effectiveDate = $_GET['effectiveDate'];
        $description = $_GET['description'];
        $account_head = $_GET['account_head'];
        $voucherno = $_GET['voucherno'];
        $chequeno = $_GET['chequeno'];
        $amount = $_GET['amount'];
        $type = $_GET['type'];


        $transaction = new Transaction;
        $transaction->account_head_id = $account_head;
        $transaction->description = $description;
        $transaction->amount = $amount;
        $transaction->transaction_date = $transactionDate;
        $transaction->created_at = date('Y-m-d hh:ii:ss');
        $transaction->voucher_no = $voucherno;
        $transaction->cheque_no = $chequeno;
        $transaction->effective_date = $effectiveDate;

        if($transaction->save()){
            return 'success';
        }
        else{
            return 'error';
        }
    }
}
