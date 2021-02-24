<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name','staff_code','email','role','rights_body', 'mobile','designation','address','department','password','verified','user_type',
    // ];
   protected $fillable = [
        'name', 'staff_code', 'email', 'role', 'rights_body', 'mobile', 'designation','address', 'department','description', 'password','verified','user_type','email_token','user_type','remember_token',
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class,'user_permission','user_id','permission_id');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthIdentifier()
    {
        return $this->id;
    }
}
