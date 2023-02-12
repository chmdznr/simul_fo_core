<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCoreConfigRequest;
use App\Http\Requests\StoreCoreConfigRequest;
use App\Http\Requests\UpdateCoreConfigRequest;
use App\Models\Asset;
use App\Models\CoreConfig;
use App\Models\SegmentConnected;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoreConfigController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('core_config_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CoreConfig::with(['segment_1', 'segment_2', 'asset_connector'])->select(sprintf('%s.*', (new CoreConfig())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'core_config_show';
                $editGate = 'core_config_edit';
                $deleteGate = 'core_config_delete';
                $crudRoutePart = 'core-configs';

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
            $table->addColumn('segment_1_segid', function ($row) {
                return $row->segment_1 ? $row->segment_1->segid : '';
            });

            $table->editColumn('segment_1.alias', function ($row) {
                return $row->segment_1 ? (is_string($row->segment_1) ? $row->segment_1 : $row->segment_1->alias) : '';
            });
            $table->addColumn('segment_2_segid', function ($row) {
                return $row->segment_2 ? $row->segment_2->segid : '';
            });

            $table->editColumn('segment_2.alias', function ($row) {
                return $row->segment_2 ? (is_string($row->segment_2) ? $row->segment_2 : $row->segment_2->alias) : '';
            });
            $table->editColumn('splice_type', function ($row) {
                return $row->splice_type ? CoreConfig::SPLICE_TYPE_SELECT[$row->splice_type] : '';
            });
            $table->addColumn('asset_connector_serial_number', function ($row) {
                return $row->asset_connector ? $row->asset_connector->serial_number : '';
            });

            $table->editColumn('asset_connector.aid', function ($row) {
                return $row->asset_connector ? (is_string($row->asset_connector) ? $row->asset_connector : $row->asset_connector->aid) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'segment_1', 'segment_2', 'asset_connector']);

            return $table->make(true);
        }

        $segment_connecteds = SegmentConnected::get();
        $assets             = Asset::get();

        return view('admin.coreConfigs.index', compact('segment_connecteds', 'assets'));
    }

    public function create()
    {
        abort_if(Gate::denies('core_config_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $segment_1s = SegmentConnected::pluck('segid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $segment_2s = SegmentConnected::pluck('segid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset_connectors = Asset::pluck('serial_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.coreConfigs.create', compact('asset_connectors', 'segment_1s', 'segment_2s'));
    }

    public function store(StoreCoreConfigRequest $request)
    {
        $coreConfig = CoreConfig::create($request->all());

        return redirect()->route('admin.core-configs.index');
    }

    public function edit(CoreConfig $coreConfig)
    {
        abort_if(Gate::denies('core_config_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $segment_1s = SegmentConnected::pluck('segid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $segment_2s = SegmentConnected::pluck('segid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $asset_connectors = Asset::pluck('serial_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coreConfig->load('segment_1', 'segment_2', 'asset_connector');

        return view('admin.coreConfigs.edit', compact('asset_connectors', 'coreConfig', 'segment_1s', 'segment_2s'));
    }

    public function update(UpdateCoreConfigRequest $request, CoreConfig $coreConfig)
    {
        $coreConfig->update($request->all());

        return redirect()->route('admin.core-configs.index');
    }

    public function show(CoreConfig $coreConfig)
    {
        abort_if(Gate::denies('core_config_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coreConfig->load('segment_1', 'segment_2', 'asset_connector', 'coreConfigCoreConnections');

        return view('admin.coreConfigs.show', compact('coreConfig'));
    }

    public function destroy(CoreConfig $coreConfig)
    {
        abort_if(Gate::denies('core_config_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coreConfig->delete();

        return back();
    }

    public function massDestroy(MassDestroyCoreConfigRequest $request)
    {
        CoreConfig::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
