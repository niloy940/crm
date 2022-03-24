<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalfProductMakeInternalLotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('half_product_make_internal_lot', function (Blueprint $table) {
            $table->unsignedBigInteger('half_product_make_id');
            $table->foreign('half_product_make_id')->references('id')->on('half_product_makes')->onDelete('cascade');
            $table->unsignedBigInteger('internal_lot_id');
            $table->foreign('internal_lot_id')->references('id')->on('internal_lots')->onDelete('cascade');
            
            $table->decimal('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('half_product_make_internal_lot');
    }
}
