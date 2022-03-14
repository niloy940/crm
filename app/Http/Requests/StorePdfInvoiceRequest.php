<?php

namespace App\Http\Requests;

use App\Models\PdfInvoice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePdfInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pdf_invoice_create');
    }

    public function rules()
    {
        return [
            'customer_id' => [
                'required',
                'integer',
            ],
            'type' => [
                'required',
            ],
            'status' => [
                'required',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'required',
                'array',
            ],
            'discount' => [
                'numeric',
            ],
            'pay_until' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'note' => [
                'string',
                'max:90',
                'nullable',
            ],
        ];
    }
}
