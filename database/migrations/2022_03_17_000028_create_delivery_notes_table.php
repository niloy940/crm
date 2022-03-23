<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryNotesTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->float('quantity', 8, 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
