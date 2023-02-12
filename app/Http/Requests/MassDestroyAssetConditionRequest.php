<?php

namespace App\Http\Requests;

use App\Models\AssetCondition;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAssetConditionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('asset_condition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:asset_conditions,id',
        ];
    }
}
