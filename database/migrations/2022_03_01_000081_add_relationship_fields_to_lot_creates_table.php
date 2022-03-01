<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLotCreatesTable extends Migration
{
    public function up()
    {
        Schema::table('lot_creates', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6104090')->references('id')->on('teams');
        });
    }
}
