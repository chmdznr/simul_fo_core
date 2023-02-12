<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitePointsTable extends Migration
{
    public function up()
    {
        Schema::create('site_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sid')->unique();
            $table->string('site_name');
            $table->float('latitude', 16, 10);
            $table->float('longitude', 16, 10);
            $table->string('address')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('region')->nullable();
            $table->string('area')->nullable();
            $table->string('cluster')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
