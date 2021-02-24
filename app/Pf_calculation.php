<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pf_calculation extends Model
{
    protected $fillable = [
        'name','own_pf', 'organization_pf','total_pf',
    	];
}
