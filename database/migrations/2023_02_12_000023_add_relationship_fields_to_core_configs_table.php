<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCoreConfigsTable extends Migration
{
    public function up()
    {
        Schema::table('core_configs', function (Blueprint $table) {
            $table->unsignedBigInteger('segment_1_id')->nullable();
            $table->foreign('segment_1_id', 'segment_1_fk_8019613')->references('id')->on('segment_connecteds');
            $table->unsignedBigInteger('segment_2_id')->nullable();
            $table->foreign('segment_2_id', 'segment_2_fk_8019614')->references('id')->on('segment_connecteds');
            $table->unsignedBigInteger('asset_connector_id')->nullable();
            $table->foreign('asset_connector_id', 'asset_connector_fk_8019616')->references('id')->on('assets');
        });
    }
}
