@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.coreConfig.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.core-configs.update", [$coreConfig->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.coreConfig.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $coreConfig->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coreConfig.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="segment_1_id">{{ trans('cruds.coreConfig.fields.segment_1') }}</label>
                <select class="form-control select2 {{ $errors->has('segment_1') ? 'is-invalid' : '' }}" name="segment_1_id" id="segment_1_id" required>
                    @foreach($segment_1s as $id => $entry)
                        <option value="{{ $id }}" {{ (old('segment_1_id') ? old('segment_1_id') : $coreConfig->segment_1->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('segment_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('segment_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coreConfig.fields.segment_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="segment_2_id">{{ trans('cruds.coreConfig.fields.segment_2') }}</label>
                <select class="form-control select2 {{ $errors->has('segment_2') ? 'is-invalid' : '' }}" name="segment_2_id" id="segment_2_id" required>
                    @foreach($segment_2s as $id => $entry)
                        <option value="{{ $id }}" {{ (old('segment_2_id') ? old('segment_2_id') : $coreConfig->segment_2->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('segment_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('segment_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coreConfig.fields.segment_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.coreConfig.fields.splice_type') }}</label>
                <select class="form-control {{ $errors->has('splice_type') ? 'is-invalid' : '' }}" name="splice_type" id="splice_type" required>
                    <option value disabled {{ old('splice_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CoreConfig::SPLICE_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('splice_type', $coreConfig->splice_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('splice_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('splice_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coreConfig.fields.splice_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="asset_connector_id">{{ trans('cruds.coreConfig.fields.asset_connector') }}</label>
                <select class="form-control select2 {{ $errors->has('asset_connector') ? 'is-invalid' : '' }}" name="asset_connector_id" id="asset_connector_id">
                    @foreach($asset_connectors as $id => $entry)
                        <option value="{{ $id }}" {{ (old('asset_connector_id') ? old('asset_connector_id') : $coreConfig->asset_connector->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('asset_connector'))
                    <div class="invalid-feedback">
                        {{ $errors->first('asset_connector') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.coreConfig.fields.asset_connector_helper') }}</span>
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