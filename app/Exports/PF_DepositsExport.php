<?php

namespace App\Exports;

use App\PF_Deposit;
use Maatwebsite\Excel\Concerns\FromCollection;

class PF_DepositsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PF_Deposit::all();
    }
}
