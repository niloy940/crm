<?php

namespace App\Http\Requests;

use App\Models\HalfProductMake;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHalfProductMakeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('half_product_make_create');
    }

    public function rules()
    {
        return [
            'halfproduct_id' => [
                'required',
                'integer',
            ],
            'products' => [
                'required',
                'array',
            ],
            'quantities' => [
                'required',
                'array',
            ],
            'int_lot' => [
                'required',
                'string'
            ],
            'int_lots' => [
                'required',
                'array',
            ],
            'quantity' => [
                'numeric',
                'required',
            ],
            'made_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
