<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptNotesTable extends Migration
{
    public function up()
    {
        Schema::create('receipt_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->float('quantity', 8, 3)->nullable();
            $table->string('lot')->unique();
            // $table->string('int_lot')->unique();
            $table->date('expiry_date');
            $table->string('shelf')->nullable();
            $table->string('qc');
            $table->string('conditions');
            $table->string('shift');
            $table->date('date');
            $table->string('place');
            $table->string('driver');
            $table->string('id_driver');
            $table->string('registration');
            $table->string('print')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
