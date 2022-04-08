<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDeliveryNotesTable extends Migration
{
    public function up()
    {
        Schema::table('delivery_notes', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_6050996')->references('id')->on('crm_customers');
            // $table->unsignedBigInteger('product_id')->nullable();
            // $table->foreign('product_id', 'product_fk_6050997')->references('id')->on('products_lists');
            // $table->unsignedBigInteger('int_lot_id')->nullable();
            // $table->foreign('int_lot_id', 'int_lot_fk_6159782')->references('id')->on('receipt_notes');
            $table->unsignedBigInteger('issuer_id')->nullable();
            $table->foreign('issuer_id', 'issuer_fk_6051000')->references('id')->on('users');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6051005')->references('id')->on('teams');
        });
    }
}
