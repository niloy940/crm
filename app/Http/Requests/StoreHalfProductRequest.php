<?php

namespace App\Http\Requests;

use App\Models\HalfProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHalfProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('half_product_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'max:15',
                'required',
                'unique:half_products',
            ],
        ];
    }
}
