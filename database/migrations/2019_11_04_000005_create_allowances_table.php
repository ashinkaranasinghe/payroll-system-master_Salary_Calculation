<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllowancesTable extends Migration
{
    public function up()
    {
        Schema::create('allowances', function (Blueprint $table) {
            $table->increments('id');

            $table->string('year')->nullable();

            $table->string('month');

            $table->decimal('amount', 15, 2);

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
