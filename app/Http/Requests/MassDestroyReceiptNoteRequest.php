<?php

namespace App\Http\Requests;

use App\Models\ReceiptNote;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyReceiptNoteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('receipt_note_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:receipt_notes,id',
        ];
    }
}
