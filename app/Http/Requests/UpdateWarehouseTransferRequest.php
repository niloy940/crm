<?php

namespace App\Http\Requests;

use App\Models\WarehouseTransfer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWarehouseTransferRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('warehouse_transfer_edit');
    }

    public function rules()
    {
        return [
            'warehouse_from_id' => [
                'required',
                'integer',
            ],
            'warehouse_to_id' => [
                'required',
                'integer',
            ],
            'int_lot_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
