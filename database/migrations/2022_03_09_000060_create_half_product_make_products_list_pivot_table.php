<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalfProductMakeProductsListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('half_product_make_products_list', function (Blueprint $table) {
            $table->unsignedBigInteger('half_product_make_id');
            $table->foreign('half_product_make_id', 'half_product_make_id_fk_6103781')->references('id')->on('half_product_makes')->onDelete('cascade');
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6103781')->references('id')->on('products_lists')->onDelete('cascade');
        });
    }
}
