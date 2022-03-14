<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLotTracksTable extends Migration
{
    public function up()
    {
        Schema::table('lot_tracks', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6104186')->references('id')->on('teams');
        });
    }
}
