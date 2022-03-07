<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillMaterialsTable extends Migration
{
    public function up()
    {
        Schema::create('bill_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->float('price', 8, 3);
            $table->float('quantity', 8, 3);
            $table->float('coefficient', 5, 3);
            $table->float('total', 7, 3)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
