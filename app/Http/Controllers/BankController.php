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

        // dd($end_date);

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


        $query = "(select -1 as id,'' as transaction_date,'End of Month Balance' as description,ifnull(amount,0) as amount, (case when (amount < 0) THEN 'Payment' ELSE '' END) as type,
            '' as voucher_no, '' as cheque_no, '' as account_head
            from transactions
            where effective_date between '".$start_date."' and '".$end_date."'
            and description = 'End of Month Balance'
          and is_bank_book=0)
          union
          (select t.id as id,date_format(t.transaction_date,'%d %b %Y') as transaction_date, t.description, t.amount, (case when (t.amount < 0) THEN 'Payment' ELSE '' END) as type, t.voucher_no, t.cheque_no, ah.account_head
          from transactions as t
          inner join account_heads as ah
          on t.account_head_id = ah.id
          where t.effective_date between '".$start_date."' and '".$end_date."'
          and t.is_bank_book=0)";
        //dd($query);

        $results = DB::select($query);

        // dd($results);
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

        $query = "select -1 as id,'' as transaction_date,'Balance ".$last_month."' as description, (
            (select sum(total_pf) from pf_deposit where `deposit_date` <= '".$last_date."')
            + (select ifnull(sum(amount),0) from transactions where transaction_date <= '".$last_date."' and is_bank_book = 1)
            ) as amount, '' as voucher_no, '' as cheque_no, '' as account_head, '' as voucher_type
            union
            select -1 as id,'' as transaction_date,'Employee Contribution ".$con_month."' as description, sum(own_pf) as amount, '' as voucher_no, '' as cheque_no, '' as account_head, (case when (sum(own_pf)>0) THEN 'Received' ELSE 'Payment' END) as voucher_type
            from pf_deposit where `deposit_date` between '".$start_date."' and '".$end_date."'
            union
            select -1 as id,'' as transaction_date,'Employer Contribution ".$con_month."' as description, sum(organization_pf) as amount, '' as voucher_no, '' as cheque_no, '' as account_head, (case when (sum(organization_pf)>0) THEN 'Received' ELSE 'Payment' END) as voucher_type
            from pf_deposit where `deposit_date` between '".$start_date."' and '".$end_date."'
            union
            (select t.id as id,date_format(t.transaction_date,'%d %b %Y') as transaction_date, t.description, t.amount, t.voucher_no, t.cheque_no, ah.account_head, (case when (t.amount>0) THEN 'Received' ELSE 'Payment' END) as voucher_type
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
        $bank_transaction_type = $_GET['bank_transaction_type'];


        $transaction = new Transaction;
        $transaction->account_head_id = $account_head;
        $transaction->description = $description;
        $transaction->amount = $amount;
        $transaction->transaction_date = $transactionDate.' 00:00:00';
        $transaction->created_at = date('Y-m-d h:i:s');
        $transaction->voucher_no = $voucherno;
        $transaction->cheque_no = $chequeno;
        $transaction->effective_date = $effectiveDate.' 00:00:00';


        if($bank_transaction_type == 'BOTH'){
            //entry into bank book
            $transaction->is_bank_book = 1;
            if($transaction->save()){
                    $transaction2 = new Transaction;
                    $transaction2->account_head_id = $account_head;
                    $transaction2->description = $description;
                    $transaction2->amount = $amount;
                    $transaction2->transaction_date = $transactionDate.' 00:00:00';
                    $transaction2->created_at = date('Y-m-d h:i:s');
                    $transaction2->voucher_no = $voucherno;
                    $transaction2->cheque_no = $chequeno;
                    $transaction2->effective_date = $effectiveDate.' 00:00:00';
                    $transaction2->is_bank_book = 0;
                    if($transaction2->save()){
                        return 'success';
                    }
                    else{
                        return 'error';
                    }
            }
                else{
                    return 'error';
            }
        }
        else{
            if($bank_transaction_type == 'R') $transaction->is_bank_book = 0;
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

    public function save_end_of_month(){
        $transactionDate = $_GET['transactionDate'];
        $amount = $_GET['amount'];

        $from_date = $_GET['transactionDate'];
        $from_date = $from_date.'-01';

        //get last date of previous month
        $last_date = date('Y-m-d',strtotime('-1 second',strtotime(date($from_date))));
        $last_month = date('M,Y',strtotime('-1 second',strtotime(date($from_date))));

        $con_month = date('M,Y',strtotime(date($from_date)));
        $end_date = date("Y-m-t", strtotime($from_date));
        $start_date = $from_date;

        $checkQuery = "select * from transactions as t where t.description='End of Month Balance' and t.effective_date between '".$start_date."' and '".$end_date."'";

        $results = DB::select($checkQuery);

        if($results){
            return 'End of Month balance already exists!';
        }
        else{
            $transaction = new Transaction;
            $transaction->description = 'End of Month Balance';
            $transaction->amount = $amount;
            $transaction->transaction_date = $transactionDate.'-01 00:00:00';
            $transaction->effective_date = $transactionDate.'-01 00:00:00';
            $transaction->is_bank_book = 0;

            if($transaction->save()){
                return 'success';
            }
            else{
                return 'error';
            }
        }        
    }

    public function add_to_reconciliation(){
        $transactionDate = $_GET['transactionDate'];
        $id = $_GET['id'];

        $from_date = $_GET['transactionDate'];
        $from_date = $from_date.'-01';

        //get last date of previous month
        $last_date = date('Y-m-d',strtotime('-1 second',strtotime(date($from_date))));
        $last_month = date('M,Y',strtotime('-1 second',strtotime(date($from_date))));

        $con_month = date('M,Y',strtotime(date($from_date)));
        $end_date = date("Y-m-t", strtotime($from_date));
        $start_date = $from_date;

        //check if we have that id in that month or not
        $checkQuery = "select * from transactions as t where t.id=".$id." and t.effective_date between '".$start_date."' and '".$end_date."'";

        $results = DB::select($checkQuery);

        if($results){
            //got data
            //now we need to check if already inserted
            $checkALQuery = "select * from transactions as t where t.description='".$results[0]->description."' and t.is_bank_book = 0 and t.effective_date between '".$start_date."' and '".$end_date."'";
            $resultALQuery = DB::select($checkALQuery);
            if($resultALQuery){
                return 'Information already inserted for that month';
            }
            else{
                //we need to entry that values
                $transaction = new Transaction;
                $transaction->account_head_id = $results[0]->account_head_id;
                $transaction->description = $results[0]->description;
                $transaction->amount = $results[0]->amount;
                $transaction->transaction_date = $results[0]->transaction_date;
                $transaction->effective_date = $results[0]->effective_date;
                $transaction->voucher_no = $results[0]->voucher_no;
                $transaction->cheque_no = $results[0]->cheque_no;
                $transaction->is_bank_book = 0;

                if($transaction->save()){
                    return 'success';
                }
                else{
                    return 'error';
                }
            }
        }
        else{
            return 'This entry is not valid for this month';
        }
    }

}