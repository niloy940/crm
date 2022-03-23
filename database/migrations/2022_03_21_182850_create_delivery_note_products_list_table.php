<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryNoteProductsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_note_products_list', function (Blueprint $table) {
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id')->references('id')->on('products_lists')->onDelete('cascade');

            $table->unsignedBigInteger('delivery_note_id');
            $table->foreign('delivery_note_id')->references('id')->on('delivery_notes')->onDelete('cascade');

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
        Schema::dropIfExists('delivery_note_products_list');
    }
}
