<?php

namespace App\Http\Requests;

use App\Models\ProductPrice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductPriceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_price_create');
    }

    public function rules()
    {
        return [
            'bom_id' => [
                'required',
                'integer',
            ],
            'quantity' => [
                'numeric',
            ],
        ];
    }
}
