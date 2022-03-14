<?php

namespace App\Http\Requests;

use App\Models\NoteOfRecepitInterProcess;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNoteOfRecepitInterProcessRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('note_of_recepit_inter_process_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:note_of_recepit_inter_processes,id',
        ];
    }
}
