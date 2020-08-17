<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $fillable = [
        'base_name', 'base_description',
    ];
}
