<?php

namespace App\Http\Requests;

use App\Models\HalfProductMake;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHalfProductMakeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('half_product_make_edit');
    }

    public function rules()
    {
        return [
            'halfproduct_id' => [
                'required',
                'integer',
            ],
            'ingridients.*' => [
                'integer',
            ],
            'ingridients' => [
                'required',
                'array',
            ],
            'quantity' => [
                'numeric',
                'required',
            ],
            'int_lots.*' => [
                'integer',
            ],
            'int_lots' => [
                'required',
                'array',
            ],
            'made_by_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
