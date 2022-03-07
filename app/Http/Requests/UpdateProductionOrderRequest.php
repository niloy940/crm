<?php

namespace App\Http\Requests;

use App\Models\ProductionOrder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductionOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('production_order_edit');
    }

    public function rules()
    {
        return [
            'due_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'description' => [
                'required',
            ],
            'recommended' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
