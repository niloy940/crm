<?php

namespace App\Http\Requests;

use App\Models\PackingList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPackingListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('packing_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:packing_lists,id',
        ];
    }
}
