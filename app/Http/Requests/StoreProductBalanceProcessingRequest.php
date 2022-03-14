<?php

namespace App\Http\Requests;

use App\Models\ProductBalanceProcessing;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductBalanceProcessingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_balance_processing_create');
    }

    public function rules()
    {
        return [
            'balance_max' => [
                'numeric',
            ],
        ];
    }
}
