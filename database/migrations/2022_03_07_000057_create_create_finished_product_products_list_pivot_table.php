<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateFinishedProductProductsListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('create_finished_product_products_list', function (Blueprint $table) {
            $table->unsignedBigInteger('create_finished_product_id');
            $table->foreign('create_finished_product_id', 'create_finished_product_id_fk_6144726')->references('id')->on('create_finished_products')->onDelete('cascade');
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6144726')->references('id')->on('products_lists')->onDelete('cascade');
        });
    }
}
