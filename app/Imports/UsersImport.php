<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class UsersImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        
        return new User([
            // 'name'          => $row[0],
            // 'staff_code'    => $row[1], 
            // 'email'         => $row[2], 
            // 'role'          => $row[3], 
            // 'rights_body'   => $row[4], 
            // 'mobile'        => $row[5],
            // 'designation'   => $row[6], 
            // 'address'       => $row[7], 
            // 'department'    => $row[8], 
            // 'description'   => $row[9], 
            // 'password'      => $row[10],
            // 'verified'      => $row[11],
            // 'email_token'      => $row[12],
            // 'user_type'      => $row[13],
            // 'remember_token'      => $row[14], 
          
           
           
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}