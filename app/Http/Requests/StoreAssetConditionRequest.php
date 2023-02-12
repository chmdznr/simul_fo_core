<?php

namespace App\Http\Requests;

use App\Models\AssetCondition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAssetConditionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('asset_condition_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:asset_conditions',
            ],
        ];
    }
}
