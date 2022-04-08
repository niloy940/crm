<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalfProductMakesTable extends Migration
{
    public function up()
    {
        Schema::create('half_product_makes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('quantity');
            $table->decimal('processing_quantity')->nullable();
            $table->decimal('finished_quantity')->nullable();
            $table->string('int_lot');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
