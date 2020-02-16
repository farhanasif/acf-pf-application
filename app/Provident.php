<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provident extends Model
{
      protected $fillable = [
        'deposite_code', 'staff_code', 'own_pf', 'organization_pf', 'total_pf',
    	];
}
