<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteOfRecepitInterProcessProductsListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('note_of_recepit_inter_process_products_list', function (Blueprint $table) {
            $table->unsignedBigInteger('note_of_recepit_inter_process_id');
            $table->foreign('note_of_recepit_inter_process_id', 'note_of_recepit_inter_process_id_fk_6083373')->references('id')->on('note_of_recepit_inter_processes')->onDelete('cascade');
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6083373')->references('id')->on('products_lists')->onDelete('cascade');
        });
    }
}
