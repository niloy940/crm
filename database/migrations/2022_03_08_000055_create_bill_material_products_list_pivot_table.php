<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillMaterialProductsListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bill_material_products_list', function (Blueprint $table) {
            $table->unsignedBigInteger('bill_material_id');
            $table->foreign('bill_material_id', 'bill_material_id_fk_6103536')->references('id')->on('bill_materials')->onDelete('cascade');
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6103536')->references('id')->on('products_lists')->onDelete('cascade');
        });
    }
}
