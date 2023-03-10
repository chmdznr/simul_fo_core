<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aid')->nullable()->unique();
            $table->string('brand')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
