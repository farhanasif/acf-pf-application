<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function users(){
        return $this->belongsToMany(User::class,'user_permission','permission_id','user_id');
    }
}
