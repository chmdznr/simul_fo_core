<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoreConnectionRequest;
use App\Http\Requests\UpdateCoreConnectionRequest;
use App\Http\Resources\Admin\CoreConnectionResource;
use App\Models\CoreConnection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreConnectionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('core_connection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoreConnectionResource(CoreConnection::with(['core_config'])->get());
    }

    public function store(StoreCoreConnectionRequest $request)
    {
        $coreConnection = CoreConnection::create($request->all());

        return (new CoreConnectionResource($coreConnection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CoreConnection $coreConnection)
    {
        abort_if(Gate::denies('core_connection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoreConnectionResource($coreConnection->load(['core_config']));
    }

    public function update(UpdateCoreConnectionRequest $request, CoreConnection $coreConnection)
    {
        $coreConnection->update($request->all());

        return (new CoreConnectionResource($coreConnection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CoreConnection $coreConnection)
    {
        abort_if(Gate::denies('core_connection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coreConnection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
