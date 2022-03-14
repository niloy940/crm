<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPdfInvoiceRequest;
use App\Http\Requests\StorePdfInvoiceRequest;
use App\Http\Requests\UpdatePdfInvoiceRequest;
use App\Models\CrmCustomer;
use App\Models\PdfInvoice;
use App\Models\ProductsList;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PdfInvoiceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pdf_invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pdfInvoices = PdfInvoice::with(['customer', 'products', 'team'])->get();

        $crm_customers = CrmCustomer::get();

        $products_lists = ProductsList::get();

        $teams = Team::get();

        return view('admin.pdfInvoices.index', compact('crm_customers', 'pdfInvoices', 'products_lists', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('pdf_invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id');

        return view('admin.pdfInvoices.create', compact('customers', 'products'));
    }

    public function store(StorePdfInvoiceRequest $request)
    {
        $pdfInvoice = PdfInvoice::create($request->all());
        $pdfInvoice->products()->sync($request->input('products', []));

        return redirect()->route('admin.pdf-invoices.index');
    }

    public function edit(PdfInvoice $pdfInvoice)
    {
        abort_if(Gate::denies('pdf_invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = CrmCustomer::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = ProductsList::pluck('name', 'id');

        $pdfInvoice->load('customer', 'products', 'team');

        return view('admin.pdfInvoices.edit', compact('customers', 'pdfInvoice', 'products'));
    }

    public function update(UpdatePdfInvoiceRequest $request, PdfInvoice $pdfInvoice)
    {
        $pdfInvoice->update($request->all());
        $pdfInvoice->products()->sync($request->input('products', []));

        return redirect()->route('admin.pdf-invoices.index');
    }

    public function show(PdfInvoice $pdfInvoice)
    {
        abort_if(Gate::denies('pdf_invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pdfInvoice->load('customer', 'products', 'team');

        return view('admin.pdfInvoices.show', compact('pdfInvoice'));
    }

    public function destroy(PdfInvoice $pdfInvoice)
    {
        abort_if(Gate::denies('pdf_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pdfInvoice->delete();

        return back();
    }

    public function massDestroy(MassDestroyPdfInvoiceRequest $request)
    {
        PdfInvoice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
