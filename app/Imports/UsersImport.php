<?php

namespace App\Imports;
use Illuminate\Support\Facades\Hash;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


          return new User([

             // 'name'         =>$row[0],
             // 'staff_code'   =>$row[1],
             // 'email'        =>$row[2],
             // 'role'         =>$row[3],
             // 'rights_body'  =>$row[4],
             // 'mobile'       =>$row[5],
             // 'designation'  =>$row[6],
             // 'address'      =>$row[7],
             // 'department'   =>$row[8],
             // 'password'     =>$row[9],
             // 'user_type'    =>$row[10],

             'name'    =>$row[1],
             'staff_code'    =>$row[2],
             'email'    =>$row[3],
             'role'    =>$row[4],
             'rights_body'    =>$row[5],
             'mobile'    =>$row[6],
             'designation'    =>$row[7],
             'address'    => $row[8],
             'department' => $row[9],
             'password'    =>$row[10],
             'user_type'    => $row[11],


             // 'name'           =>$row["name"],
             // 'staff_code'     =>$row["staff_code"],
             // 'email'          =>$row["email"],
             // 'role'           =>$row["role"],
             // 'rights_body'    =>$row["rights_body"],
             // 'mobile'         =>$row["mobile"],
             // 'designation'    =>$row["designation"],
             // 'address'        => $row["address"],
             // 'department'     => $row["department"],
             // 'password'       =>$row["password"],
             // 'user_type'      => $row["user_type"],

         ]);
    }
}
