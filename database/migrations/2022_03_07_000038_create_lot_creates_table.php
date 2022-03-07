<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotCreatesTable extends Migration
{
    public function up()
    {
        Schema::create('lot_creates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('int_lot');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
