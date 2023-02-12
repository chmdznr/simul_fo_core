<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAssetConditionRequest;
use App\Http\Requests\UpdateAssetConditionRequest;
use App\Http\Resources\Admin\AssetConditionResource;
use App\Models\AssetCondition;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssetConditionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('asset_condition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetConditionResource(AssetCondition::all());
    }

    public function store(StoreAssetConditionRequest $request)
    {
        $assetCondition = AssetCondition::create($request->all());

        return (new AssetConditionResource($assetCondition))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AssetCondition $assetCondition)
    {
        abort_if(Gate::denies('asset_condition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AssetConditionResource($assetCondition);
    }

    public function update(UpdateAssetConditionRequest $request, AssetCondition $assetCondition)
    {
        $assetCondition->update($request->all());

        return (new AssetConditionResource($assetCondition))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AssetCondition $assetCondition)
    {
        abort_if(Gate::denies('asset_condition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCondition->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
