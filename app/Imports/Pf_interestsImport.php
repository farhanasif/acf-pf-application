<?php

namespace App\Imports;

use App\Pf_interest;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Auth;

class Pf_interestsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pf_interest([
            
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
