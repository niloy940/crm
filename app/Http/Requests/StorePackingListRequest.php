<?php

namespace App\Http\Requests;

use App\Models\PackingList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePackingListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('packing_list_create');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'quantity' => [
                'numeric',
                'required',
            ],
            'net_weight' => [
                'numeric',
                'required',
            ],
            'bruto_weight' => [
                'numeric',
                'required',
            ],
            'width' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'height' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'length' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
