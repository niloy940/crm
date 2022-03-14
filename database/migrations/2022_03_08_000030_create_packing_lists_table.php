<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackingListsTable extends Migration
{
    public function up()
    {
        Schema::create('packing_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('quantity', 9, 3);
            $table->float('net_weight', 8, 3);
            $table->float('bruto_weight', 8, 3);
            $table->integer('width');
            $table->integer('height');
            $table->integer('length');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
