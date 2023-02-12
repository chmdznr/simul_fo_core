<?php

namespace App\Http\Requests;

use App\Models\CoreConfig;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCoreConfigRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('core_config_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'segment_1_id' => [
                'required',
                'integer',
            ],
            'segment_2_id' => [
                'required',
                'integer',
            ],
            'splice_type' => [
                'required',
            ],
        ];
    }
}
