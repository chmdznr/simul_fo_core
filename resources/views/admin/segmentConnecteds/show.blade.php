@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.segmentConnected.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.segment-connecteds.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.id') }}
                        </th>
                        <td>
                            {{ $segmentConnected->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.segid') }}
                        </th>
                        <td>
                            {{ $segmentConnected->segid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.alias') }}
                        </th>
                        <td>
                            {{ $segmentConnected->alias }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.site_point_1') }}
                        </th>
                        <td>
                            {{ $segmentConnected->site_point_1->sid ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.site_point_2') }}
                        </th>
                        <td>
                            {{ $segmentConnected->site_point_2->sid ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.segmentConnected.fields.total_core') }}
                        </th>
                        <td>
                            {{ $segmentConnected->total_core }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.segment-connecteds.index') }}">
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
            <a class="nav-link" href="#segment1_core_configs" role="tab" data-toggle="tab">
                {{ trans('cruds.coreConfig.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#segment2_core_configs" role="tab" data-toggle="tab">
                {{ trans('cruds.coreConfig.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="segment1_core_configs">
            @includeIf('admin.segmentConnecteds.relationships.segment1CoreConfigs', ['coreConfigs' => $segmentConnected->segment1CoreConfigs])
        </div>
        <div class="tab-pane" role="tabpanel" id="segment2_core_configs">
            @includeIf('admin.segmentConnecteds.relationships.segment2CoreConfigs', ['coreConfigs' => $segmentConnected->segment2CoreConfigs])
        </div>
    </div>
</div>

@endsection