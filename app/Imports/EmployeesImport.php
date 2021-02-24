<?php

namespace App\Imports;

use App\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Auth;

class EmployeesImport implements  WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {

    //     return new Employee([
    //         // 'staff_code'            => $row[0],
    //         // 'trimmed'               => $row[1],
    //         // 'first_name'            => $row[2],
    //         // 'last_name'             => $row[3],
    //         // 'position'              => $row[4],
    //         // 'department_code'       => $row[5],
    //         // 'category'              => $row[6],
    //         // 'level'                 => $row[7],
    //         // 'base'                  => $row[8],
    //         // 'work_place'            => $row[9],
    //         // 'sub_location'          => $row[10],
    //         // 'basic_salary'          => $row[11],
    //         // 'gross_salary'          => $row[12],
    //         // 'pf_amount'             => $row[13],
    //         // 'pf_percentage'         => $row[14],
    //         // 'joining_date'          => $row[15],
    //         // 'ending_date'           => $row[16],
    //     ]);
    // }

    // public function model(array $row) {
    //     if(!array_filter($row)) 
    //     { return null;
    //     }

    //     $leave_date = $row[9] ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row[9]))->format('Y-m-d') : null;
    //    return new Employee([
    //                   'staff_code' =>$row[0],
    //                   'trimmed' =>$row[0],
    //                   'first_name' =>$row[1],
    //                   'last_name' =>$row[2],
    //                   'position' =>$row[3],
    //                   'department_code' =>$row[4],
    //                   'category' =>$row[4],
    //                   'level' =>$row[5],
    //                   // 'joining_date' =>date('Y-m-d H:m:s', strtotime($row[7])),
    //                   // 'joining_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['7'])->format('Y-m-d'),
    //                   'joining_date' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(intval($row[7]))->format('Y-m-d'),
    //                   'ending_date' =>$leave_date,
    //                   // 'ending_date' =>date('Y-m-d H:m:s', strtotime($row[9])),
    //                   // 'ending_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['9'])->format('Y-m-d') != "00/00/0000" ?  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['9'])->format('Y-m-d') : '00/00/0000' ,
    //                   'base' =>$row[10],
    //                   'work_place' =>$row[10],
    //                   'sub_location' =>$row[10],
    //                   'basic_salary' =>$row[12],
    //                   'gross_salary' =>$row[13],
    //                   'pf_amount' =>$row[16],
    //                   // 'pf_percentage' =>$NULL,
    //                   'status' => $leave_date ? 0 : 1,
    //                   'created_by' =>Auth::user()->id,
    //                   'updated_by' =>Auth::user()->id,
    //     ]);
    // }

    public function startRow(): int
    {
        return 2;
    }

}
