<?php

namespace App\Http\Requests;

use App\Models\WarehouseSector;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWarehouseSectorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('warehouse_sector_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:warehouse_sectors',
            ],
        ];
    }
}
