<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateFinishedProductsTable extends Migration
{
    public function up()
    {
        Schema::create('create_finished_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shift');
            $table->date('expiry_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
