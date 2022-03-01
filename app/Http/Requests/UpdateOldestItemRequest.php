<?php

namespace App\Http\Requests;

use App\Models\OldestItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOldestItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('oldest_item_edit');
    }

    public function rules()
    {
        return [];
    }
}
