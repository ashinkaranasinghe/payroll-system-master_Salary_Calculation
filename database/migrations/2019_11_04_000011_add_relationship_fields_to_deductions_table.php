<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDeductionsTable extends Migration
{
    public function up()
    {
        Schema::table('deductions', function (Blueprint $table) {
            $table->unsignedInteger('employee_id');

            $table->foreign('employee_id', 'employee_fk_561542')->references('id')->on('employees');
        });
    }
}
