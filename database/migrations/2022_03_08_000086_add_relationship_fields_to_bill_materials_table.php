<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBillMaterialsTable extends Migration
{
    public function up()
    {
        Schema::table('bill_materials', function (Blueprint $table) {
            $table->unsignedBigInteger('for_product_id')->nullable();
            $table->foreign('for_product_id', 'for_product_fk_6103535')->references('id')->on('products_lists');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6103540')->references('id')->on('teams');
        });
    }
}
