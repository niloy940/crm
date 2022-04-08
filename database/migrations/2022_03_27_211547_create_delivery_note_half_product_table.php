<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryNoteHalfProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_note_half_product', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_note_id');
            $table->foreign('delivery_note_id')->references('id')->on('delivery_notes')->onDelete('cascade');
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
        Schema::dropIfExists('delivery_note_half_product');
    }
}
