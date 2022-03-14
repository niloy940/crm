<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWarehousesListsTable extends Migration
{
    public function up()
    {
        Schema::table('warehouses_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6050592')->references('id')->on('teams');
        });
    }
}
