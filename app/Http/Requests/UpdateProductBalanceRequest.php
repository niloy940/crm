<?php

namespace App\Http\Requests;

use App\Models\ProductBalance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductBalanceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_balance_edit');
    }

    public function rules()
    {
        return [];
    }
}
