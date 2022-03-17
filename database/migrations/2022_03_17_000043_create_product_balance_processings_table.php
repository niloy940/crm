<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBalanceProcessingsTable extends Migration
{
    public function up()
    {
        Schema::create('product_balance_processings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('quantity', 9, 3)->nullable();
            $table->float('balance_max', 8, 2)->nullable();
            $table->float('balance_reserved', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
