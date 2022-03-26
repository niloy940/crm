<?php

namespace App\Http\Requests;

use App\Models\CreateFinishedProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCreateFinishedProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('create_finished_product_create');
    }

    public function rules()
    {
        return [
            'shift' => [
                'required',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'required',
                'array',
            ],
            'int_lots' => [
                'required',
                'array',
            ],
            'quantities' => [
                'array',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'expiry_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'processing_spent_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
