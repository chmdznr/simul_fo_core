<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSegmentConnectedsTable extends Migration
{
    public function up()
    {
        Schema::table('segment_connecteds', function (Blueprint $table) {
            $table->unsignedBigInteger('site_point_1_id')->nullable();
            $table->foreign('site_point_1_id', 'site_point_1_fk_8019585')->references('id')->on('site_points');
            $table->unsignedBigInteger('site_point_2_id')->nullable();
            $table->foreign('site_point_2_id', 'site_point_2_fk_8019586')->references('id')->on('site_points');
        });
    }
}
