<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCoreConnectionRequest;
use App\Http\Requests\StoreCoreConnectionRequest;
use App\Http\Requests\UpdateCoreConnectionRequest;
use App\Models\CoreConfig;
use App\Models\CoreConnection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoreConnectionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('core_connection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CoreConnection::with(['core_config'])->select(sprintf('%s.*', (new CoreConnection())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'core_connection_show';
                $editGate = 'core_connection_edit';
                $deleteGate = 'core_connection_delete';
                $crudRoutePart = 'core-connections';

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
            $table->addColumn('core_config_name', function ($row) {
                return $row->core_config ? $row->core_config->name : '';
            });

            $table->editColumn('core_config.splice_type', function ($row) {
                return $row->core_config ? (is_string($row->core_config) ? $row->core_config : $row->core_config->splice_type) : '';
            });
            $table->editColumn('core_number_1', function ($row) {
                return $row->core_number_1 ? $row->core_number_1 : '';
            });
            $table->editColumn('core_number_2', function ($row) {
                return $row->core_number_2 ? $row->core_number_2 : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'core_config']);

            return $table->make(true);
        }

        $core_configs = CoreConfig::get();

        return view('admin.coreConnections.index', compact('core_configs'));
    }

    public function create()
    {
        abort_if(Gate::denies('core_connection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $core_configs = CoreConfig::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.coreConnections.create', compact('core_configs'));
    }

    public function store(StoreCoreConnectionRequest $request)
    {
        $coreConnection = CoreConnection::create($request->all());

        return redirect()->route('admin.core-connections.index');
    }

    public function edit(CoreConnection $coreConnection)
    {
        abort_if(Gate::denies('core_connection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $core_configs = CoreConfig::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coreConnection->load('core_config');

        return view('admin.coreConnections.edit', compact('coreConnection', 'core_configs'));
    }

    public function update(UpdateCoreConnectionRequest $request, CoreConnection $coreConnection)
    {
        $coreConnection->update($request->all());

        return redirect()->route('admin.core-connections.index');
    }

    public function show(CoreConnection $coreConnection)
    {
        abort_if(Gate::denies('core_connection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coreConnection->load('core_config');

        return view('admin.coreConnections.show', compact('coreConnection'));
    }

    public function destroy(CoreConnection $coreConnection)
    {
        abort_if(Gate::denies('core_connection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coreConnection->delete();

        return back();
    }

    public function massDestroy(MassDestroyCoreConnectionRequest $request)
    {
        CoreConnection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
