<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_location extends Model
{
    protected $fillable = [
        'sub_location_name', 'sub_location_description',
    ];
}
