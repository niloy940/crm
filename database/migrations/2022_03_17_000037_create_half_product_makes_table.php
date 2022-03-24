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
            $table->string('int_lot');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
