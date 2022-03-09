<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWarehouseTransfersTable extends Migration
{
    public function up()
    {
        Schema::table('warehouse_transfers', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_from_id')->nullable();
            $table->foreign('warehouse_from_id', 'warehouse_from_fk_6051282')->references('id')->on('warehouses_lists');
            $table->unsignedBigInteger('warehouse_to_id')->nullable();
            $table->foreign('warehouse_to_id', 'warehouse_to_fk_6051283')->references('id')->on('warehouses_lists');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_6051284')->references('id')->on('products_lists');
            $table->unsignedBigInteger('int_lot_id')->nullable();
            $table->foreign('int_lot_id', 'int_lot_fk_6159804')->references('id')->on('receipt_notes');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6051286')->references('id')->on('users');
            $table->unsignedBigInteger('user_received_id')->nullable();
            $table->foreign('user_received_id', 'user_received_fk_6051287')->references('id')->on('users');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6051291')->references('id')->on('teams');
        });
    }
}
