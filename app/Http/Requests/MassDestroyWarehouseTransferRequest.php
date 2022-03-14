<?php

namespace App\Http\Requests;

use App\Models\WarehouseTransfer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWarehouseTransferRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('warehouse_transfer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:warehouse_transfers,id',
        ];
    }
}
