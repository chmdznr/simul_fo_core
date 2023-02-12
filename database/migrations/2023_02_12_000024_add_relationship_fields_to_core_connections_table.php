<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCoreConnectionsTable extends Migration
{
    public function up()
    {
        Schema::table('core_connections', function (Blueprint $table) {
            $table->unsignedBigInteger('core_config_id')->nullable();
            $table->foreign('core_config_id', 'core_config_fk_8019622')->references('id')->on('core_configs');
        });
    }
}
