<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsListReceiptNotePivotTable extends Migration
{
    public function up()
    {
        Schema::create('products_list_receipt_note', function (Blueprint $table) {
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6083461')->references('id')->on('products_lists')->onDelete('cascade');
            $table->unsignedBigInteger('receipt_note_id');
            $table->foreign('receipt_note_id', 'receipt_note_id_fk_6083461')->references('id')->on('receipt_notes')->onDelete('cascade');
            $table->decimal('quantity');
        });
    }
}
