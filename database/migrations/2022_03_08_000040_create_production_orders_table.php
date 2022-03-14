<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('production_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('due_date');
            $table->date('recommended');
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
