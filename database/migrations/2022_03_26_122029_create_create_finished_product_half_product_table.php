<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateFinishedProductHalfProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('create_finished_product_half_product', function (Blueprint $table) {
            $table->unsignedBigInteger('finished_product_id');
            $table->foreign('finished_product_id')->references('id')->on('create_finished_products')->onDelete('cascade');
            $table->unsignedBigInteger('half_product_id');
            $table->foreign('half_product_id')->references('id')->on('half_products')->onDelete('cascade');

            $table->string('int_lot');
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
        Schema::dropIfExists('create_finished_product_half_product');
    }
}
