<?php

namespace App\Http\Requests;

use App\Models\SegmentConnected;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSegmentConnectedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('segment_connected_edit');
    }

    public function rules()
    {
        return [
            'segid' => [
                'string',
                'required',
                'unique:segment_connecteds,segid,' . request()->route('segment_connected')->id,
            ],
            'alias' => [
                'string',
                'nullable',
            ],
            'site_point_1_id' => [
                'required',
                'integer',
            ],
            'total_core' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
