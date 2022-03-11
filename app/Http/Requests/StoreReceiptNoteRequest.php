<?php

namespace App\Http\Requests;

use App\Models\ReceiptNote;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReceiptNoteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('receipt_note_create');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'required',
                'array',
            ],
            'quantity' => [
                'numeric',
                'required',
            ],
            'lot' => [
                'string',
                'min:3',
                'max:30',
                'required',
                'unique:receipt_notes',
            ],
            'int_lot' => [
                'string',
                'min:3',
                'max:35',
                'required',
                'unique:receipt_notes',
            ],
            'expiry_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'warehouse_id' => [
                'required',
                'integer',
            ],
            'sector_id' => [
                'required',
                'integer',
            ],
            'shelf' => [
                'string',
                'nullable',
            ],
            'qc' => [
                'required',
            ],
            'conditions' => [
                'required',
            ],
            'shift' => [
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'place' => [
                'string',
                'min:3',
                'max:25',
                'required',
            ],
            'driver' => [
                'string',
                'required',
            ],
            'id_driver' => [
                'string',
                'required',
            ],
            'registration' => [
                'string',
                'min:3',
                'max:20',
                'required',
            ],
        ];
    }
}
