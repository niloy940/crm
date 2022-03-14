<?php

namespace App\Http\Requests;

use App\Models\ProductionSpent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductionSpentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('production_spent_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:production_spents',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'required',
                'array',
            ],
            'quantity' => [
                'numeric',
                'required',
            ],
            'shift' => [
                'required',
            ],
            'date_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'quantity_ing' => [
                'numeric',
                'required',
            ],
        ];
    }
}
