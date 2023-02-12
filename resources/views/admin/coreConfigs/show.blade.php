@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coreConfig.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.core-configs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConfig.fields.id') }}
                        </th>
                        <td>
                            {{ $coreConfig->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConfig.fields.name') }}
                        </th>
                        <td>
                            {{ $coreConfig->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConfig.fields.segment_1') }}
                        </th>
                        <td>
                            {{ $coreConfig->segment_1->segid ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConfig.fields.segment_2') }}
                        </th>
                        <td>
                            {{ $coreConfig->segment_2->segid ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConfig.fields.splice_type') }}
                        </th>
                        <td>
                            {{ App\Models\CoreConfig::SPLICE_TYPE_SELECT[$coreConfig->splice_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConfig.fields.asset_connector') }}
                        </th>
                        <td>
                            {{ $coreConfig->asset_connector->serial_number ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.core-configs.index') }}">
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
            <a class="nav-link" href="#core_config_core_connections" role="tab" data-toggle="tab">
                {{ trans('cruds.coreConnection.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="core_config_core_connections">
            @includeIf('admin.coreConfigs.relationships.coreConfigCoreConnections', ['coreConnections' => $coreConfig->coreConfigCoreConnections])
        </div>
    </div>
</div>

@endsection