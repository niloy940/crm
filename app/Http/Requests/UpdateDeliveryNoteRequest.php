<?php

namespace App\Http\Requests;

use App\Models\DeliveryNote;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDeliveryNoteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('delivery_note_edit');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
            'quantity' => [
                'numeric',
                'required',
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
