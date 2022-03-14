<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBalanceProductsListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_balance_products_list', function (Blueprint $table) {
            $table->unsignedBigInteger('product_balance_id');
            $table->foreign('product_balance_id', 'product_balance_id_fk_6086150')->references('id')->on('product_balances')->onDelete('cascade');
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6086150')->references('id')->on('products_lists')->onDelete('cascade');
        });
    }
}
