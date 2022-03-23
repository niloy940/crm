<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalLotWarehouseTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_lot_warehouse_transfer', function (Blueprint $table) {
            $table->unsignedBigInteger('internal_lot_id');
            $table->foreign('internal_lot_id')->references('id')->on('internal_lots')->onDelete('cascade');

            $table->unsignedBigInteger('warehouse_transfer_id');
            $table->foreign('warehouse_transfer_id')->references('id')->on('warehouse_transfers')->onDelete('cascade');

            $table->decimal('reserved_quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_lot_warehouse_transfer');
    }
}
