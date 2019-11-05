<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAllowancesTable extends Migration
{
    public function up()
    {
        Schema::table('allowances', function (Blueprint $table) {
            $table->unsignedInteger('employee_id');

            $table->foreign('employee_id', 'employee_fk_561489')->references('id')->on('employees');
        });
    }
}
