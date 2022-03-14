<?php

namespace App\Http\Requests;

use App\Models\HalfProductMake;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHalfProductMakeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('half_product_make_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:half_product_makes,id',
        ];
    }
}
