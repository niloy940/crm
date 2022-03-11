<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionSpentsTable extends Migration
{
    public function up()
    {
        Schema::create('production_spents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->float('quantity', 8, 3);
            $table->string('shift');
            $table->datetime('date_time');
            $table->float('quantity_ing', 8, 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
