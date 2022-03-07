<?php

namespace App\Http\Requests;

use App\Models\LotCreate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLotCreateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lot_create_edit');
    }

    public function rules()
    {
        return [
            'int_lot' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
