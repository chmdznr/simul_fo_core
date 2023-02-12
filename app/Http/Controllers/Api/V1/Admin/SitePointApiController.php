<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSitePointRequest;
use App\Http\Requests\UpdateSitePointRequest;
use App\Http\Resources\Admin\SitePointResource;
use App\Models\SitePoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SitePointApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('site_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SitePointResource(SitePoint::all());
    }

    public function store(StoreSitePointRequest $request)
    {
        $sitePoint = SitePoint::create($request->all());

        return (new SitePointResource($sitePoint))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SitePoint $sitePoint)
    {
        abort_if(Gate::denies('site_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SitePointResource($sitePoint);
    }

    public function update(UpdateSitePointRequest $request, SitePoint $sitePoint)
    {
        $sitePoint->update($request->all());

        return (new SitePointResource($sitePoint))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SitePoint $sitePoint)
    {
        abort_if(Gate::denies('site_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sitePoint->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
