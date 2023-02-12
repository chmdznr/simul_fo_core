<?php

namespace App\Http\Requests;

use App\Models\CoreConnection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCoreConnectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('core_connection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:core_connections,id',
        ];
    }
}
