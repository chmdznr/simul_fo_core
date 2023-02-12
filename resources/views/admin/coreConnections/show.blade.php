@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coreConnection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.core-connections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConnection.fields.id') }}
                        </th>
                        <td>
                            {{ $coreConnection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConnection.fields.core_config') }}
                        </th>
                        <td>
                            {{ $coreConnection->core_config->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConnection.fields.core_number_1') }}
                        </th>
                        <td>
                            {{ $coreConnection->core_number_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coreConnection.fields.core_number_2') }}
                        </th>
                        <td>
                            {{ $coreConnection->core_number_2 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.core-connections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection