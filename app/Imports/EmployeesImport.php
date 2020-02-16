<?php

namespace App\Imports;

use App\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EmployeesImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'staff_code'            => $row[0],
            'trimmed'               => $row[1], 
            'first_name'            => $row[2], 
            'last_name'             => $row[3], 
            'position'              => $row[4], 
            'department_code'       => $row[5],
            'category'              => $row[6], 
            'level'                 => $row[7], 
            'base'                  => $row[8], 
            'work_place'            => $row[9], 
            'sub_location'          => $row[10],
            'basic_salary'          => $row[11],
            'gross_salary'          => $row[12],
            'pf_amount'             => $row[13],
            'pf_percentage'         => $row[14], 
            'joining_date'          => $row[15],
            'ending_date'           => $row[16], 
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
