<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductPricesTable extends Migration
{
    public function up()
    {
        Schema::table('product_prices', function (Blueprint $table) {
            $table->unsignedBigInteger('bom_id')->nullable();
            $table->foreign('bom_id', 'bom_fk_6155043')->references('id')->on('bill_materials');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6155010')->references('id')->on('teams');
        });
    }
}
