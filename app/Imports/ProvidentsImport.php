<?php

namespace App\Imports;

use App\Provident;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProvidentsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Provident([
            'deposite_code'     => $row[0],
            'staff_code'        => $row[1], 
            'own_pf'            => $row[2], 
            'organization_pf'   => $row[3], 
            'total_pf'          => $row[4], 
           
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
