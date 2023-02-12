<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoreConfigRequest;
use App\Http\Requests\UpdateCoreConfigRequest;
use App\Http\Resources\Admin\CoreConfigResource;
use App\Models\CoreConfig;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreConfigApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('core_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoreConfigResource(CoreConfig::with(['segment_1', 'segment_2', 'asset_connector'])->get());
    }

    public function store(StoreCoreConfigRequest $request)
    {
        $coreConfig = CoreConfig::create($request->all());

        return (new CoreConfigResource($coreConfig))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CoreConfig $coreConfig)
    {
        abort_if(Gate::denies('core_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoreConfigResource($coreConfig->load(['segment_1', 'segment_2', 'asset_connector']));
    }

    public function update(UpdateCoreConfigRequest $request, CoreConfig $coreConfig)
    {
        $coreConfig->update($request->all());

        return (new CoreConfigResource($coreConfig))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CoreConfig $coreConfig)
    {
        abort_if(Gate::denies('core_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coreConfig->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
