<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHalfProductMakesTable extends Migration
{
    public function up()
    {
        Schema::table('half_product_makes', function (Blueprint $table) {
            $table->unsignedBigInteger('halfproduct_id')->nullable();
            $table->foreign('halfproduct_id', 'halfproduct_fk_6103780')->references('id')->on('half_products');
            $table->unsignedBigInteger('made_by_id')->nullable();
            $table->foreign('made_by_id', 'made_by_fk_6103783')->references('id')->on('users');
        });
    }
}
