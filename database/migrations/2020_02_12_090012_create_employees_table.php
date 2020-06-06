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
            $table->integer('staff_code')->nullable();
            $table->integer('trimmed')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('position')->nullable();
            $table->string('department_code')->nullable();
            $table->string('category')->nullable();
            $table->string('level')->nullable();
            $table->string('base')->nullable();
            $table->string('work_place')->nullable();
            $table->string('sub_location')->nullable();
            $table->float('basic_salary')->nullable();
            $table->float('gross_salary')->nullable();
            $table->float('pf_amount')->nullable();
            $table->float('pf_percentage')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('ending_date')->nullable();
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
