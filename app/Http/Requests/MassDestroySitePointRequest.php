<?php

namespace App\Http\Requests;

use App\Models\SitePoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySitePointRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('site_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:site_points,id',
        ];
    }
}
