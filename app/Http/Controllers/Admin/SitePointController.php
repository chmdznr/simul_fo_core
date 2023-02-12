<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySitePointRequest;
use App\Http\Requests\StoreSitePointRequest;
use App\Http\Requests\UpdateSitePointRequest;
use App\Models\SitePoint;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SitePointController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('site_point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SitePoint::query()->select(sprintf('%s.*', (new SitePoint())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'site_point_show';
                $editGate = 'site_point_edit';
                $deleteGate = 'site_point_delete';
                $crudRoutePart = 'site-points';

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
            $table->editColumn('sid', function ($row) {
                return $row->sid ? $row->sid : '';
            });
            $table->editColumn('site_name', function ($row) {
                return $row->site_name ? $row->site_name : '';
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : '';
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('kode_pos', function ($row) {
                return $row->kode_pos ? $row->kode_pos : '';
            });
            $table->editColumn('kelurahan', function ($row) {
                return $row->kelurahan ? $row->kelurahan : '';
            });
            $table->editColumn('kecamatan', function ($row) {
                return $row->kecamatan ? $row->kecamatan : '';
            });
            $table->editColumn('kabupaten', function ($row) {
                return $row->kabupaten ? $row->kabupaten : '';
            });
            $table->editColumn('provinsi', function ($row) {
                return $row->provinsi ? $row->provinsi : '';
            });
            $table->editColumn('region', function ($row) {
                return $row->region ? $row->region : '';
            });
            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : '';
            });
            $table->editColumn('cluster', function ($row) {
                return $row->cluster ? $row->cluster : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.sitePoints.index');
    }

    public function create()
    {
        abort_if(Gate::denies('site_point_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sitePoints.create');
    }

    public function store(StoreSitePointRequest $request)
    {
        $sitePoint = SitePoint::create($request->all());

        return redirect()->route('admin.site-points.index');
    }

    public function edit(SitePoint $sitePoint)
    {
        abort_if(Gate::denies('site_point_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sitePoints.edit', compact('sitePoint'));
    }

    public function update(UpdateSitePointRequest $request, SitePoint $sitePoint)
    {
        $sitePoint->update($request->all());

        return redirect()->route('admin.site-points.index');
    }

    public function show(SitePoint $sitePoint)
    {
        abort_if(Gate::denies('site_point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sitePoint->load('siteAssets', 'sitePoint1SegmentConnecteds', 'sitePoint2SegmentConnecteds');

        return view('admin.sitePoints.show', compact('sitePoint'));
    }

    public function destroy(SitePoint $sitePoint)
    {
        abort_if(Gate::denies('site_point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sitePoint->delete();

        return back();
    }

    public function massDestroy(MassDestroySitePointRequest $request)
    {
        SitePoint::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
