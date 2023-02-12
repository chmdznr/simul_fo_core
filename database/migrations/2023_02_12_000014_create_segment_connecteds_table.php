<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentConnectedsTable extends Migration
{
    public function up()
    {
        Schema::create('segment_connecteds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('segid')->unique();
            $table->string('alias')->nullable();
            $table->integer('total_core');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
