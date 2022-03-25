<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalfProductProductionSpentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('half_product_production_spent', function (Blueprint $table) {
            $table->unsignedBigInteger('production_spent_id');
            $table->foreign('production_spent_id')->references('id')->on('production_spents')->onDelete('cascade');
            $table->unsignedBigInteger('half_product_id');
            $table->foreign('half_product_id')->references('id')->on('half_products')->onDelete('cascade');

            $table->string('int_lot');
            $table->decimal('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('half_product_production_spent');
    }
}
