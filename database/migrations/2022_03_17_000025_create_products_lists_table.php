<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsListsTable extends Migration
{
    public function up()
    {
        Schema::create('products_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('quantity')->nullable();
            $table->float('price', 6, 2);
            $table->string('measure');
            $table->float('balance_optimal', 7, 2);
            $table->float('balance_min', 7, 2);
            $table->float('balance_max', 8, 2);
            $table->float('balance_reserved')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
