<?php

namespace App\Exports;

use App\Interest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InterestsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Interest::all();
        return Interest::select(['interest_date','interest_source','staff_code','own','organization'])->get();
    }
    public function headings(): array
    {
       return [
         'Interest Date',
         'Interest Source',
         'Staff Code',
         'Own',
         'Organization',
        ];
     }
}
