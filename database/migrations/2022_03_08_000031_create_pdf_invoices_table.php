<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdfInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('pdf_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('status');
            $table->float('discount', 4, 2)->nullable();
            $table->integer('pay_until')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
