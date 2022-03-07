<?php

namespace App\Http\Requests;

use App\Models\ProductionSpent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductionSpentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('production_spent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:production_spents,id',
        ];
    }
}
