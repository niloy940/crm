<?php

namespace App\Http\Requests;

use App\Models\ProductsList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductsListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('products_list_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'max:32',
                'required',
            ],
            'warehouse_id' => [
                'required',
                'integer',
            ],
            'price' => [
                'numeric',
            ],
            'measure' => [
                'required',
            ],
            'balance_optimal' => [
                'numeric',
                'required',
            ],
            'balance_min' => [
                'numeric',
                'required',
            ],
            'balance_max' => [
                'numeric',
                'required',
            ],
        ];
    }
}
