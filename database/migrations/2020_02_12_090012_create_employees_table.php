<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('staff_code');
            $table->integer('trimmed');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('position');
            $table->string('department_code');
            $table->string('category');
            $table->string('level');
            $table->string('base');
            $table->string('work_place');
            $table->string('sub_location');
            $table->float('basic_salary');
            $table->float('gross_salary');
            $table->float('pf_amount');
            $table->float('pf_percentage');
            $table->date('joining_date');
            $table->date('ending_date');
            $table->string('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
