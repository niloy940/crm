<?php

namespace App\Http\Requests;

use App\Models\ProductsList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProductsListRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('products_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:products_lists,id',
        ];
    }
}
