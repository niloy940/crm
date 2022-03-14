<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalfProductMakeReceiptNotePivotTable extends Migration
{
    public function up()
    {
        Schema::create('half_product_make_receipt_note', function (Blueprint $table) {
            $table->unsignedBigInteger('half_product_make_id');
            $table->foreign('half_product_make_id', 'half_product_make_id_fk_6104062')->references('id')->on('half_product_makes')->onDelete('cascade');
            $table->unsignedBigInteger('receipt_note_id');
            $table->foreign('receipt_note_id', 'receipt_note_id_fk_6104062')->references('id')->on('receipt_notes')->onDelete('cascade');
        });
    }
}
