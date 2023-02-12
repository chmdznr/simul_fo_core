<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySegmentConnectedRequest;
use App\Http\Requests\StoreSegmentConnectedRequest;
use App\Http\Requests\UpdateSegmentConnectedRequest;
use App\Models\SegmentConnected;
use App\Models\SitePoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SegmentConnectedController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('segment_connected_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SegmentConnected::with(['site_point_1', 'site_point_2'])->select(sprintf('%s.*', (new SegmentConnected())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'segment_connected_show';
                $editGate = 'segment_connected_edit';
                $deleteGate = 'segment_connected_delete';
                $crudRoutePart = 'segment-connecteds';

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
            $table->editColumn('segid', function ($row) {
                return $row->segid ? $row->segid : '';
            });
            $table->editColumn('alias', function ($row) {
                return $row->alias ? $row->alias : '';
            });
            $table->addColumn('site_point_1_sid', function ($row) {
                return $row->site_point_1 ? $row->site_point_1->sid : '';
            });

            $table->editColumn('site_point_1.site_name', function ($row) {
                return $row->site_point_1 ? (is_string($row->site_point_1) ? $row->site_point_1 : $row->site_point_1->site_name) : '';
            });
            $table->addColumn('site_point_2_sid', function ($row) {
                return $row->site_point_2 ? $row->site_point_2->sid : '';
            });

            $table->editColumn('site_point_2.site_name', function ($row) {
                return $row->site_point_2 ? (is_string($row->site_point_2) ? $row->site_point_2 : $row->site_point_2->site_name) : '';
            });
            $table->editColumn('total_core', function ($row) {
                return $row->total_core ? $row->total_core : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'site_point_1', 'site_point_2']);

            return $table->make(true);
        }

        $site_points = SitePoint::get();

        return view('admin.segmentConnecteds.index', compact('site_points'));
    }

    public function create()
    {
        abort_if(Gate::denies('segment_connected_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $site_point_1s = SitePoint::pluck('sid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $site_point_2s = SitePoint::pluck('sid', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.segmentConnecteds.create', compact('site_point_1s', 'site_point_2s'));
    }

    public function store(StoreSegmentConnectedRequest $request)
    {
        $segmentConnected = SegmentConnected::create($request->all());

        return redirect()->route('admin.segment-connecteds.index');
    }

    public function edit(SegmentConnected $segmentConnected)
    {
        abort_if(Gate::denies('segment_connected_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $site_point_1s = SitePoint::pluck('sid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $site_point_2s = SitePoint::pluck('sid', 'id')->prepend(trans('global.pleaseSelect'), '');

        $segmentConnected->load('site_point_1', 'site_point_2');

        return view('admin.segmentConnecteds.edit', compact('segmentConnected', 'site_point_1s', 'site_point_2s'));
    }

    public function update(UpdateSegmentConnectedRequest $request, SegmentConnected $segmentConnected)
    {
        $segmentConnected->update($request->all());

        return redirect()->route('admin.segment-connecteds.index');
    }

    public function show(SegmentConnected $segmentConnected)
    {
        abort_if(Gate::denies('segment_connected_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $segmentConnected->load('site_point_1', 'site_point_2', 'segment1CoreConfigs', 'segment2CoreConfigs');

        return view('admin.segmentConnecteds.show', compact('segmentConnected'));
    }

    public function destroy(SegmentConnected $segmentConnected)
    {
        abort_if(Gate::denies('segment_connected_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $segmentConnected->delete();

        return back();
    }

    public function massDestroy(MassDestroySegmentConnectedRequest $request)
    {
        SegmentConnected::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
