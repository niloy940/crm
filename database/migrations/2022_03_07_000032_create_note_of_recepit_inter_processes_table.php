<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteOfRecepitInterProcessesTable extends Migration
{
    public function up()
    {
        Schema::create('note_of_recepit_inter_processes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('quantity', 8, 3);
            $table->string('qc');
            $table->string('conditions');
            $table->string('shift');
            $table->date('date');
            $table->string('print')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
