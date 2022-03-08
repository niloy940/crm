<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductionSpentsTable extends Migration
{
    public function up()
    {
        Schema::table('production_spents', function (Blueprint $table) {
            $table->unsignedBigInteger('ingridients_id')->nullable();
            $table->foreign('ingridients_id', 'ingridients_fk_6152041')->references('id')->on('products_lists');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6144825')->references('id')->on('teams');
        });
    }
}
