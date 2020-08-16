<?php

namespace App\Exports;

use App\Provident;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProvidentFundsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Provident::all();
        return Provident::select(['deposit_date','staff_code','own_pf','organization_pf','total_pf'])->get();
    }

    public function headings(): array
    {
       return [
         'Deposit Date',
         'Staff Code',
         'Own PF',
         'Organization PF',
         'Total PF',
        ];
     }
}
