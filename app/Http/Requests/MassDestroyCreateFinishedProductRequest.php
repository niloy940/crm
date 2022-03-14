<?php

namespace App\Http\Requests;

use App\Models\CreateFinishedProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCreateFinishedProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('create_finished_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:create_finished_products,id',
        ];
    }
}
