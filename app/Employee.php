<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     protected $fillable = [
        'staff_code', 'trimmed', 'first_name', 'last_name', 'position', 'department_code', 'category','level', 'base','work_place', 'sub_location','basic_salary','gross_salary','pf_amount','user_type','pf_percentage','joining_date','ending_date','status',
    ];
}