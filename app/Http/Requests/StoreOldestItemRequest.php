<?php

namespace App\Http\Requests;

use App\Models\OldestItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOldestItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('oldest_item_create');
    }

    public function rules()
    {
        return [];
    }
}
