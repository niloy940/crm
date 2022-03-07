<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsListTimeEntryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('products_list_time_entry', function (Blueprint $table) {
            $table->unsignedBigInteger('time_entry_id');
            $table->foreign('time_entry_id', 'time_entry_id_fk_6128314')->references('id')->on('time_entries')->onDelete('cascade');
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6128314')->references('id')->on('products_lists')->onDelete('cascade');
        });
    }
}
