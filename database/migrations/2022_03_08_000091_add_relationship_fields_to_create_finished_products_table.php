<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCreateFinishedProductsTable extends Migration
{
    public function up()
    {
        Schema::table('create_finished_products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6144728')->references('id')->on('users');
            $table->unsignedBigInteger('processing_spent_id')->nullable();
            $table->foreign('processing_spent_id', 'processing_spent_fk_6144839')->references('id')->on('production_spents');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6144732')->references('id')->on('teams');
        });
    }
}
