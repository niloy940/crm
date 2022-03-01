<?php

namespace App\Http\Requests;

use App\Models\NoteOfRecepitInterProcess;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNoteOfRecepitInterProcessRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('note_of_recepit_inter_process_create');
    }

    public function rules()
    {
        return [
            'products.*' => [
                'integer',
            ],
            'products' => [
                'required',
                'array',
            ],
            'int_lot_id' => [
                'required',
                'integer',
            ],
            'quantity' => [
                'numeric',
                'required',
            ],
            'warehouse_id' => [
                'required',
                'integer',
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
            'issuer_id' => [
                'required',
                'integer',
            ],
            'received_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
