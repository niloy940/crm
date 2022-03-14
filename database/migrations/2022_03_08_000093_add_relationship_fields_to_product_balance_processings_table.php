<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductBalanceProcessingsTable extends Migration
{
    public function up()
    {
        Schema::table('product_balance_processings', function (Blueprint $table) {
            $table->unsignedBigInteger('halfproduct_id')->nullable();
            $table->foreign('halfproduct_id', 'halfproduct_fk_6153155')->references('id')->on('half_product_makes');
            $table->unsignedBigInteger('balance_min_id')->nullable();
            $table->foreign('balance_min_id', 'balance_min_fk_6153116')->references('id')->on('products_lists');
            $table->unsignedBigInteger('balance_optimal_id')->nullable();
            $table->foreign('balance_optimal_id', 'balance_optimal_fk_6153117')->references('id')->on('products_lists');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6153120')->references('id')->on('teams');
        });
    }
}
