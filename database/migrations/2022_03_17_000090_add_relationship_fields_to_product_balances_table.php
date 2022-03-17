<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductBalancesTable extends Migration
{
    public function up()
    {
        Schema::table('product_balances', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6086154')->references('id')->on('teams');
            $table->unsignedBigInteger('balance_optimal_id')->nullable();
            $table->foreign('balance_optimal_id', 'balance_optimal_fk_6113013')->references('id')->on('products_lists');
            $table->unsignedBigInteger('balance_min_id')->nullable();
            $table->foreign('balance_min_id', 'balance_min_fk_6113014')->references('id')->on('products_lists');
        });
    }
}
