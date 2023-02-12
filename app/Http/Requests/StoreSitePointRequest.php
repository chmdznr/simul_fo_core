<?php

namespace App\Http\Requests;

use App\Models\SitePoint;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSitePointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('site_point_create');
    }

    public function rules()
    {
        return [
            'sid' => [
                'string',
                'required',
                'unique:site_points',
            ],
            'site_name' => [
                'string',
                'required',
            ],
            'latitude' => [
                'numeric',
                'required',
            ],
            'longitude' => [
                'numeric',
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'kode_pos' => [
                'string',
                'nullable',
            ],
            'kelurahan' => [
                'string',
                'nullable',
            ],
            'kecamatan' => [
                'string',
                'nullable',
            ],
            'kabupaten' => [
                'string',
                'nullable',
            ],
            'provinsi' => [
                'string',
                'nullable',
            ],
            'region' => [
                'string',
                'nullable',
            ],
            'area' => [
                'string',
                'nullable',
            ],
            'cluster' => [
                'string',
                'nullable',
            ],
        ];
    }
}
