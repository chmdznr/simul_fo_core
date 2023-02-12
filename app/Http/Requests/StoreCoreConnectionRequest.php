<?php

namespace App\Http\Requests;

use App\Models\CoreConnection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCoreConnectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('core_connection_create');
    }

    public function rules()
    {
        return [
            'core_config_id' => [
                'required',
                'integer',
            ],
            'core_number_1' => [
                'string',
                'required',
            ],
            'core_number_2' => [
                'string',
                'required',
            ],
        ];
    }
}
