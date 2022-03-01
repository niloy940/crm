<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldestItemReceiptNotePivotTable extends Migration
{
    public function up()
    {
        Schema::create('oldest_item_receipt_note', function (Blueprint $table) {
            $table->unsignedBigInteger('oldest_item_id');
            $table->foreign('oldest_item_id', 'oldest_item_id_fk_6083516')->references('id')->on('oldest_items')->onDelete('cascade');
            $table->unsignedBigInteger('receipt_note_id');
            $table->foreign('receipt_note_id', 'receipt_note_id_fk_6083516')->references('id')->on('receipt_notes')->onDelete('cascade');
        });
    }
}
