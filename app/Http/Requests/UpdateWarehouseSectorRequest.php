<?php

namespace App\Http\Requests;

use App\Models\WarehouseSector;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWarehouseSectorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('warehouse_sector_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:warehouse_sectors,name,' . request()->route('warehouse_sector')->id,
            ],
        ];
    }
}
