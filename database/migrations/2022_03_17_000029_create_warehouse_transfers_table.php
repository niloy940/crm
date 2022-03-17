<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseTransfersTable extends Migration
{
    public function up()
    {
        Schema::create('warehouse_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('quantity', 8, 3);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
