<?php

namespace App\Http\Requests;

use App\Models\ProductsList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductsListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('products_list_create');
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
        ];
    }
}
