<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseSectorsTable extends Migration
{
    public function up()
    {
        Schema::create('warehouse_sectors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
