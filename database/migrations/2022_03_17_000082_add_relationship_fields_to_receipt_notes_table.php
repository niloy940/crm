<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReceiptNotesTable extends Migration
{
    public function up()
    {
        Schema::table('receipt_notes', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_6050928')->references('id')->on('crm_customers');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id', 'warehouse_fk_6050832')->references('id')->on('warehouses_lists');
            $table->unsignedBigInteger('sector_id')->nullable();
            $table->foreign('sector_id', 'sector_fk_6184040')->references('id')->on('warehouse_sectors');
            $table->unsignedBigInteger('issuer_id')->nullable();
            $table->foreign('issuer_id', 'issuer_fk_6224932')->references('id')->on('users');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6051569')->references('id')->on('teams');
        });
    }
}
