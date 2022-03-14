<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNoteOfRecepitInterProcessesTable extends Migration
{
    public function up()
    {
        Schema::table('note_of_recepit_inter_processes', function (Blueprint $table) {
            $table->unsignedBigInteger('int_lot_id')->nullable();
            $table->foreign('int_lot_id', 'int_lot_fk_6104063')->references('id')->on('receipt_notes');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id', 'warehouse_fk_6083377')->references('id')->on('warehouses_lists');
            $table->unsignedBigInteger('issuer_id')->nullable();
            $table->foreign('issuer_id', 'issuer_fk_6083382')->references('id')->on('users');
            $table->unsignedBigInteger('received_by_id')->nullable();
            $table->foreign('received_by_id', 'received_by_fk_6103803')->references('id')->on('users');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6083387')->references('id')->on('teams');
        });
    }
}
