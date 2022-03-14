<?php

namespace App\Http\Requests;

use App\Models\WarehousesList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWarehousesListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('warehouses_list_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'max:25',
                'required',
            ],
        ];
    }
}
