<?php

namespace App\Http\Requests;

use App\Models\LotTrack;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLotTrackRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lot_track_edit');
    }

    public function rules()
    {
        return [
            'int_lots.*' => [
                'integer',
            ],
            'int_lots' => [
                'array',
            ],
        ];
    }
}
