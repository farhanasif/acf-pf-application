<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('staff_code');
            $table->string('email');
            $table->string('role');
            $table->string('rights_body');
            $table->string('mobile');
            $table->string('designation');
            $table->string('address');
            $table->string('department');
            $table->string('description');
            $table->string('password');
            $table->string('verified')->nullable();
            $table->string('email_token')->nullable();
            $table->string('user_type');
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
