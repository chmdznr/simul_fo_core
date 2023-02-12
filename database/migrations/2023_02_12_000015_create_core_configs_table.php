<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('core_configs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('splice_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
