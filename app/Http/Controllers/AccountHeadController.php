<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account_head;
use DB;
use Illuminate\Support\Facades\Auth;

class AccountHeadController extends Controller
{
    public function all_account_head()
    {
        $all_accounts = Account_head::all();
        return view('account_head.all_account_head',compact('all_accounts'));
    }

    public function add_account_head()
    {
        return view('account_head.add_account_head');
    }

    public function save_account_head(Request $request)
    {
        $this->validate($request,[
            'account_head' => 'required',
            'account_code' => 'required',
            'account_type' => 'required',
        ]);

        $accounts = new Account_head();
        $accounts->account_head = $request->account_head;
        $accounts->account_code = $request->account_code;
        $accounts->account_type = $request->account_type;
        $accounts->created_by= Auth::user()->id;
        $accounts->save();
        return redirect()->back()->with('success','Account head added successfully');

    }

    public function edit_account_head($id)
    {
        $account_head = Account_head::find($id);
        return view('account_head.edit_account_head',compact('account_head'));
    }

    public function update_account_head(Request $request,$id)
    {
        $this->validate($request,[
            'account_head' => 'required',
            'account_code' => 'required',
            'account_type' => 'required',
        ]);

        $accounts = Account_head::find($id);
        $accounts->account_head = $request->account_head;
        $accounts->account_code = $request->account_code;
        $accounts->account_type = $request->account_type;
        $accounts->updated_by= Auth::user()->id;
        $accounts->save();
        return redirect()->route('all-account-head')->with('success','Account head updated successfully');

    }

    public function delete_account_head($id)
    {
        $delete_account_head = Account_head::find($id);
        $delete_account_head->delete();
        return redirect()->back()->with('danger','Account head deleted successfully');
    }
}
