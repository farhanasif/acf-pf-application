<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExport()
    {
        return view('fileupload');
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function import()
    {
        $array = Excel::toArray(new UsersImport, request()->file('file'));
        dd($array);

        return back();
    }
}
