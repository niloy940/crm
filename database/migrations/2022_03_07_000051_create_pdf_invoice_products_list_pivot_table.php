<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdfInvoiceProductsListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('pdf_invoice_products_list', function (Blueprint $table) {
            $table->unsignedBigInteger('pdf_invoice_id');
            $table->foreign('pdf_invoice_id', 'pdf_invoice_id_fk_6064652')->references('id')->on('pdf_invoices')->onDelete('cascade');
            $table->unsignedBigInteger('products_list_id');
            $table->foreign('products_list_id', 'products_list_id_fk_6064652')->references('id')->on('products_lists')->onDelete('cascade');
        });
    }
}
