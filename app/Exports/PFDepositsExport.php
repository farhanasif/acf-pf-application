<?php

namespace App\Exports;

use App\Provident;
use Maatwebsite\Excel\Concerns\FromCollection;

class PFDepositsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collections
    */
    public function collection()
    {
        return Provident::all();
    }
}
