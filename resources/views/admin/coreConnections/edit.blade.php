@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.coreConnection.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.core-connections.update", [$coreConnection->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="core_config_id">{{ trans('cruds.coreConnection.fields.core_config') }}</label>
                <select class="form-control select2 {{ $errors->has('core_config') ? 'is-invalid' : '' }}" name="core_config_id" id="core_config_id" required>
                    @foreach($core_configs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('core_config_id') ? old('core_config_id') : $coreConnection->core_config->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('core_config'))
                    <div class="invalid-feedback">
                        {{ $errors->first('core_config') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coreConnection.fields.core_config_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="core_number_1">{{ trans('cruds.coreConnection.fields.core_number_1') }}</label>
                <input class="form-control {{ $errors->has('core_number_1') ? 'is-invalid' : '' }}" type="text" name="core_number_1" id="core_number_1" value="{{ old('core_number_1', $coreConnection->core_number_1) }}" required>
                @if($errors->has('core_number_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('core_number_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coreConnection.fields.core_number_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="core_number_2">{{ trans('cruds.coreConnection.fields.core_number_2') }}</label>
                <input class="form-control {{ $errors->has('core_number_2') ? 'is-invalid' : '' }}" type="text" name="core_number_2" id="core_number_2" value="{{ old('core_number_2', $coreConnection->core_number_2) }}" required>
                @if($errors->has('core_number_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('core_number_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coreConnection.fields.core_number_2_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection