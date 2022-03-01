<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotCreateLotTrackPivotTable extends Migration
{
    public function up()
    {
        Schema::create('lot_create_lot_track', function (Blueprint $table) {
            $table->unsignedBigInteger('lot_track_id');
            $table->foreign('lot_track_id', 'lot_track_id_fk_6104182')->references('id')->on('lot_tracks')->onDelete('cascade');
            $table->unsignedBigInteger('lot_create_id');
            $table->foreign('lot_create_id', 'lot_create_id_fk_6104182')->references('id')->on('lot_creates')->onDelete('cascade');
        });
    }
}
