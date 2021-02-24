<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\User;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'    => 'Admin',
            'staff_code'    => '123456',
            'email'    => 'admin@gmail.com',
            'role'    => '1',
			'rights_body'    => 'somthing',
            'mobile'    => '01746693552',
            'designation'    => 'employee',
            'address'    => 'Mohakhali',
            'department'    => 'IT',
            'description'    => 'somthing',
            'password'   =>  Hash::make('123456'),
            'verified'    => '1',
            'email_token'    => Str::random(10),
            'user_type'    => 'Admin',
            'remember_token' =>  Str::random(10),
        ]);
    }
}
