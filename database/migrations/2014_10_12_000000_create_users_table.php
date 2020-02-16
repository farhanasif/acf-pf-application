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
            $table->string('name')->nullable();
            $table->string('staff_code')->nullable();
            $table->string('email')->nullable();
            $table->string('role')->nullable();
            $table->string('rights_body')->nullable();
            $table->string('mobile')->nullable();
            $table->string('designation')->nullable();
            $table->string('address')->nullable();
            $table->string('department')->nullable();
            $table->string('description')->nullable();
            $table->string('password')->nullable();
            $table->string('verified')->nullable();
            $table->string('email_token')->nullable();
            $table->string('user_type')->nullable();
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
