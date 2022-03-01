<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOldestItemsTable extends Migration
{
    public function up()
    {
        Schema::table('oldest_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_6083515')->references('id')->on('products_lists');
            $table->unsignedBigInteger('quantity_id')->nullable();
            $table->foreign('quantity_id', 'quantity_fk_6085952')->references('id')->on('receipt_notes');
            $table->unsignedBigInteger('int_lot_id')->nullable();
            $table->foreign('int_lot_id', 'int_lot_fk_6085953')->references('id')->on('receipt_notes');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6083520')->references('id')->on('teams');
        });
    }
}
