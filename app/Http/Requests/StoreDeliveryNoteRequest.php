<?php

namespace App\Http\Requests;

use App\Models\DeliveryNote;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDeliveryNoteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('delivery_note_create');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            // 'product_id' => [
            //     'required',
            //     'integer',
            // ],
            // 'quantity' => [
            //     'numeric',
            //     'required',
            // ],
            // 'int_lot_id' => [
            //     'required',
            //     'integer',
            // ],
            'products' => [
                'required',
                'array',
            ],
            'quantities' => [
                'required',
                'array',
            ],

            'issuer_id' => [
                'required',
                'integer',
            ],
            'document' => [
                'array',
            ],
        ];
    }
}
