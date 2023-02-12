<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSegmentConnectedRequest;
use App\Http\Requests\UpdateSegmentConnectedRequest;
use App\Http\Resources\Admin\SegmentConnectedResource;
use App\Models\SegmentConnected;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SegmentConnectedApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('segment_connected_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SegmentConnectedResource(SegmentConnected::with(['site_point_1', 'site_point_2'])->get());
    }

    public function store(StoreSegmentConnectedRequest $request)
    {
        $segmentConnected = SegmentConnected::create($request->all());

        return (new SegmentConnectedResource($segmentConnected))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SegmentConnected $segmentConnected)
    {
        abort_if(Gate::denies('segment_connected_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SegmentConnectedResource($segmentConnected->load(['site_point_1', 'site_point_2']));
    }

    public function update(UpdateSegmentConnectedRequest $request, SegmentConnected $segmentConnected)
    {
        $segmentConnected->update($request->all());

        return (new SegmentConnectedResource($segmentConnected))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SegmentConnected $segmentConnected)
    {
        abort_if(Gate::denies('segment_connected_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $segmentConnected->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
