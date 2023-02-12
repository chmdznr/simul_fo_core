@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sitePoint.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.site-points.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.id') }}
                        </th>
                        <td>
                            {{ $sitePoint->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.sid') }}
                        </th>
                        <td>
                            {{ $sitePoint->sid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.site_name') }}
                        </th>
                        <td>
                            {{ $sitePoint->site_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.latitude') }}
                        </th>
                        <td>
                            {{ $sitePoint->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.longitude') }}
                        </th>
                        <td>
                            {{ $sitePoint->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.address') }}
                        </th>
                        <td>
                            {{ $sitePoint->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.kode_pos') }}
                        </th>
                        <td>
                            {{ $sitePoint->kode_pos }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.kelurahan') }}
                        </th>
                        <td>
                            {{ $sitePoint->kelurahan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.kecamatan') }}
                        </th>
                        <td>
                            {{ $sitePoint->kecamatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.kabupaten') }}
                        </th>
                        <td>
                            {{ $sitePoint->kabupaten }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.provinsi') }}
                        </th>
                        <td>
                            {{ $sitePoint->provinsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.region') }}
                        </th>
                        <td>
                            {{ $sitePoint->region }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.area') }}
                        </th>
                        <td>
                            {{ $sitePoint->area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sitePoint.fields.cluster') }}
                        </th>
                        <td>
                            {{ $sitePoint->cluster }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.site-points.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#site_assets" role="tab" data-toggle="tab">
                {{ trans('cruds.asset.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#site_point1_segment_connecteds" role="tab" data-toggle="tab">
                {{ trans('cruds.segmentConnected.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#site_point2_segment_connecteds" role="tab" data-toggle="tab">
                {{ trans('cruds.segmentConnected.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="site_assets">
            @includeIf('admin.sitePoints.relationships.siteAssets', ['assets' => $sitePoint->siteAssets])
        </div>
        <div class="tab-pane" role="tabpanel" id="site_point1_segment_connecteds">
            @includeIf('admin.sitePoints.relationships.sitePoint1SegmentConnecteds', ['segmentConnecteds' => $sitePoint->sitePoint1SegmentConnecteds])
        </div>
        <div class="tab-pane" role="tabpanel" id="site_point2_segment_connecteds">
            @includeIf('admin.sitePoints.relationships.sitePoint2SegmentConnecteds', ['segmentConnecteds' => $sitePoint->sitePoint2SegmentConnecteds])
        </div>
    </div>
</div>

@endsection