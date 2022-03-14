<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsListsTable extends Migration
{
    public function up()
    {
        Schema::table('products_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id', 'warehouse_fk_6050921')->references('id')->on('warehouses_lists');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6050575')->references('id')->on('teams');
        });
    }
}
