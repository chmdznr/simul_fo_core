<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAssetConditionRequest;
use App\Http\Requests\StoreAssetConditionRequest;
use App\Http\Requests\UpdateAssetConditionRequest;
use App\Models\AssetCondition;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AssetConditionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('asset_condition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AssetCondition::query()->select(sprintf('%s.*', (new AssetCondition())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'asset_condition_show';
                $editGate = 'asset_condition_edit';
                $deleteGate = 'asset_condition_delete';
                $crudRoutePart = 'asset-conditions';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.assetConditions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('asset_condition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetConditions.create');
    }

    public function store(StoreAssetConditionRequest $request)
    {
        $assetCondition = AssetCondition::create($request->all());

        return redirect()->route('admin.asset-conditions.index');
    }

    public function edit(AssetCondition $assetCondition)
    {
        abort_if(Gate::denies('asset_condition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetConditions.edit', compact('assetCondition'));
    }

    public function update(UpdateAssetConditionRequest $request, AssetCondition $assetCondition)
    {
        $assetCondition->update($request->all());

        return redirect()->route('admin.asset-conditions.index');
    }

    public function show(AssetCondition $assetCondition)
    {
        abort_if(Gate::denies('asset_condition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assetConditions.show', compact('assetCondition'));
    }

    public function destroy(AssetCondition $assetCondition)
    {
        abort_if(Gate::denies('asset_condition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assetCondition->delete();

        return back();
    }

    public function massDestroy(MassDestroyAssetConditionRequest $request)
    {
        AssetCondition::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
