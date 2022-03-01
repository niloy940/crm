<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBalancesTable extends Migration
{
    public function up()
    {
        Schema::create('product_balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('quantity', 9, 3)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
