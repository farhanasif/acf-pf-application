<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProvidentFundController extends Controller
{
    public function add_provident_fund()
    {
      return view('provident_fund.add_provident_fund');
    }

    public function save_provident_fund(Request $request)
    {

    }

    public function all_provident_fund()
    {
      return view('provident_fund.all_provident_fund');
    }

    public function edit_provident_fund()
    {

      return view('provident_fund.edit_provident_fund');
    }
    public function show_provident_fund_batch_upload()
    {
      return view('provident_fund.show_provident_fund_batch_upload');
    }
}
