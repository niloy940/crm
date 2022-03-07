<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionSpentProductsListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('production_spent_products_list', function (Blueprint $table) {
            $table->unsignedBigInteger('production_spent_id');
            $table->foreign('production_spent_id', 'production_spent_id_fk_6144820')->references('id')->on('production_spents')->onDelete('cascade');
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6144820')->references('id')->on('products_lists')->onDelete('cascade');
        });
    }
}
