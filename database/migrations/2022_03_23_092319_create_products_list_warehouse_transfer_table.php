<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsListWarehouseTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_list_warehouse_transfer', function (Blueprint $table) {
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id')->references('id')->on('products_lists')->onDelete('cascade');

            $table->unsignedBigInteger('warehouse_transfer_id');
            $table->foreign('warehouse_transfer_id')->references('id')->on('warehouse_transfers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_list_warehouse_transfer');
    }
}
