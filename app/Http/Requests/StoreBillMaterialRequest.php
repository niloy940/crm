<?php

namespace App\Http\Requests;

use App\Models\BillMaterial;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBillMaterialRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bill_material_create');
    }

    public function rules()
    {
        return [
            'for_product_id' => [
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
        ];
    }
}
