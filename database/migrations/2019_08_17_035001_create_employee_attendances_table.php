<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('attendance');
            $table->integer('ot');
            $table->integer('ot_hours');
            $table->float('allowances', 8, 2);
            $table->float('deductions', 8, 2);
            $table->float('epf', 8, 2);
            $table->float('etf', 8, 2);
            $table->float('total', 8, 2);
            $table->integer('month');
            $table->integer('year');
            $table->boolean('approved');
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
        Schema::dropIfExists('employee_salaries');
    }
}
