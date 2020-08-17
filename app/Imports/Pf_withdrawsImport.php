<?php

namespace App\Imports;

use App\Pf_withdraw;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Auth;
class Pf_withdrawsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pf_withdraw([
            // 'staff_code' => 1,
            // 'received_amount' => $row[3],
            // 'received_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
            // 'received_by' => Auth::user()->id,
            // 'received_in' => $row[2],
            // 'authorization_signatory' => Auth::user()->id,
            // 'description' => 1,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
