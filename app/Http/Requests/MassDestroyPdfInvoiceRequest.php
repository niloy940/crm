<?php

namespace App\Http\Requests;

use App\Models\PdfInvoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPdfInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pdf_invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pdf_invoices,id',
        ];
    }
}
