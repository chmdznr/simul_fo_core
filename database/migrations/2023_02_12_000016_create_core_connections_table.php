<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreConnectionsTable extends Migration
{
    public function up()
    {
        Schema::create('core_connections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('core_number_1');
            $table->string('core_number_2');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
