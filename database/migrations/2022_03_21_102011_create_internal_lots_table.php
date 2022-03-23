<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_lots', function (Blueprint $table) {
            $table->id();
            $table->string('int_lot')->unique();
            $table->decimal('quantity');
            $table->decimal('reserved_quantity')->nullable();

            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id')->references('id')->on('products_lists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_lots');
    }
}
