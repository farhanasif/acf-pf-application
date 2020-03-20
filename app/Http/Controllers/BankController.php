<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\AccountHead;
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
        $accountHeads = AccountHead::all();
        return view('transaction',['account_heads' => $accountHeads]);
    }

    function get_monthly_bank_book(){
        $from_date = $_GET['from_date'];
        $end_date = date("Y-m-t", strtotime($from_date));
        $start_date = substr($from_date, 0, -2) . '01';

        //dd($end_date);

        $query = "(select date_format(t.transaction_date,'%d %b %Y') as transaction_date, t.description, t.amount, t.voucher_no, t.cheque_no, ah.account_head
        from transactions as t
        inner join account_heads as ah
        on t.account_head_id = ah.id 
        where t.effective_date between '".$start_date."' and '".$end_date."'
        and t.description like 'End of month balance%')
        union
        (select date_format(t.transaction_date,'%d %b %Y') as transaction_date, t.description, t.amount, t.voucher_no, t.cheque_no, ah.account_head
        from transactions as t
        inner join account_heads as ah
        on t.account_head_id = ah.id 
        where t.effective_date between '".$start_date."' and '".$end_date."'
        and t.description not like 'End of month balance%')
        union
        (select '' as transaction_date,'TOTAL' as description, sum(amount) as amount, '' as voucher_no, '' as chaque_no, '' as account_head
         from transactions where effective_date between '".$start_date."' and '".$end_date."' )";

        //dd($query);

        $results = DB::select($query);
        //return count($results);
        return json_encode($results);
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
        $transaction->transaction_date = $transactionDate.' 00:00:00';
        $transaction->created_at = date('Y-m-d h:i:s');
        $transaction->voucher_no = $voucherno;
        $transaction->cheque_no = $chequeno;
        $transaction->effective_date = $effectiveDate.' 00:00:00';

        if($transaction->save()){
            return 'success';
        }
        else{
            return 'error';
        }
    }
}
