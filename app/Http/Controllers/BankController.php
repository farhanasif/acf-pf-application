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

//    public function view_blank(){
//         return view('blank');
//     }

    public function view_transaction(){
        $accountHeads = AccountHead::all();
        return view('transaction.transaction',['account_heads' => $accountHeads]);
    }

    public function get_monthly_bank_book(){
        $from_date = $_GET['from_date'];
        $from_date = $from_date.'-01';

        //get last date of previous month
        $last_date = date('Y-m-d',strtotime('-1 second',strtotime(date($from_date))));
        $last_month = date('M,Y',strtotime('-1 second',strtotime(date($from_date))));

        $con_month = date('M,Y',strtotime(date($from_date)));
        $end_date = date("Y-m-t", strtotime($from_date));
        $start_date = $from_date;

        //dd($end_date);

        // $query = "(select date_format(t.transaction_date,'%d %b %Y') as transaction_date, t.description, t.amount, t.voucher_no, t.cheque_no, ah.account_head
        // from transactions as t
        // inner join account_heads as ah
        // on t.account_head_id = ah.id
        // where t.effective_date between '".$start_date."' and '".$end_date."'
        // and t.description not like 'End of month balance%'
        // and t.is_bank_book=0)
        // union
        // (select date_format(t.transaction_date,'%d %b %Y') as transaction_date, t.description, t.amount, t.voucher_no, t.cheque_no, ah.account_head
        // from transactions as t
        // inner join account_heads as ah
        // on t.account_head_id = ah.id
        // where t.effective_date between '".$start_date."' and '".$end_date."'
        // and t.description like 'End of month balance%'
        // and t.is_bank_book=0)
        // union
        // (select '' as transaction_date,'TOTAL' as description, sum(amount) as amount, '' as voucher_no, '' as chaque_no, '' as account_head
        //  from transactions where effective_date between '".$start_date."' and '".$end_date."' and is_bank_book=0)";


        $query = "select '' as transaction_date,'Balance ".$last_month."' as description,
        (select ifnull(sum(amount),0) from transactions where transaction_date <= '".$last_date."' and is_bank_book = 0)
         as amount, '' as voucher_no, '' as cheque_no, '' as account_head
          union
          (select date_format(t.transaction_date,'%d %b %Y') as transaction_date, t.description, t.amount, t.voucher_no, t.cheque_no, ah.account_head
          from transactions as t
          inner join account_heads as ah
          on t.account_head_id = ah.id
          where t.effective_date between '".$start_date."' and '".$end_date."'
          and t.is_bank_book=0)";
        //dd($query);

        $results = DB::select($query);
        //return count($results);
        return json_encode($results);
    }

    public function get_monthly_bank_book_excel(){
        $from_date = $_GET['from_date'];
        $from_date = $from_date.'-01';

        //get last date of previous month
        $last_date = date('Y-m-d',strtotime('-1 second',strtotime(date($from_date))));
        $last_month = date('M,Y',strtotime('-1 second',strtotime(date($from_date))));

        $con_month = date('M,Y',strtotime(date($from_date)));
        $end_date = date("Y-m-t", strtotime($from_date));
        $start_date = $from_date;

        //dd($end_date);

        $query = "select '' as transaction_date,'Balance ".$last_month."' as description, (
            (select sum(total_pf) from pf_deposit where `deposit_date` <= '".$last_date."')
            - (select ifnull(sum(amount),0) from transactions where transaction_date <= '".$last_date."' and is_bank_book = 1)
            ) as amount, '' as voucher_no, '' as cheque_no, '' as account_head
            union
            select '' as transaction_date,'Employee Contribution ".$con_month."' as description, sum(own_pf) as amount, '' as voucher_no, '' as cheque_no, '' as account_head
            from pf_deposit where `deposit_date` between '".$start_date."' and '".$end_date."'
            union
            select '' as transaction_date,'Employer Contribution ".$con_month."' as description, sum(organization_pf) as amount, '' as voucher_no, '' as cheque_no, '' as account_head
            from pf_deposit where `deposit_date` between '".$start_date."' and '".$end_date."'
            union
            (select date_format(t.transaction_date,'%d %b %Y') as transaction_date, t.description, t.amount, t.voucher_no, t.cheque_no, ah.account_head
            from transactions as t
            inner join account_heads as ah
            on t.account_head_id = ah.id
            where t.effective_date between '".$start_date."' and '".$end_date."'
            and t.is_bank_book=1)";

        //dd($query);

        $results = DB::select($query);
        //return count($results);
        return json_encode($results);
    }


    public function save_monthly_bank_book(){

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

        if($type == 'R') $transaction->is_bank_book = 0;
        else $transaction->is_bank_book = 1;

        //dd($transaction);

        if($transaction->save()){
            return 'success';
        }
        else{
            return 'error';
        }
    }
}
