<?php

namespace App\Http\Requests;

use App\Models\DeliveryNote;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDeliveryNoteRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('delivery_note_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:delivery_notes,id',
        ];
    }
}
