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
            'product_id' => [
                'integer',
            ],
            'quantity' => [
                'numeric',
            ],
            'int_lot_id' => [
                'required',
                'integer',
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
