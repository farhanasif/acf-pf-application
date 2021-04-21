<?php

namespace App\Imports;

use App\ForfeitureAccount;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ForfeitureAccountsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ForfeitureAccount([
            //
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
