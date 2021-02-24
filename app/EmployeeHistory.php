<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeHistory extends Model
{
    protected $table = 'employee_history';

        protected $fillable = ['staff_code', 'first_name', 'last_name' , 'position' , 'department_code' , 'level', 'joining_date', 'ending_date', 'work_place', 'basic_salary', 'gross_salary', 'pf_amount'];

}
