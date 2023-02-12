@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.segmentConnected.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.segment-connecteds.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="segid">{{ trans('cruds.segmentConnected.fields.segid') }}</label>
                <input class="form-control {{ $errors->has('segid') ? 'is-invalid' : '' }}" type="text" name="segid" id="segid" value="{{ old('segid', '') }}" required>
                @if($errors->has('segid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('segid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.segmentConnected.fields.segid_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alias">{{ trans('cruds.segmentConnected.fields.alias') }}</label>
                <input class="form-control {{ $errors->has('alias') ? 'is-invalid' : '' }}" type="text" name="alias" id="alias" value="{{ old('alias', '') }}">
                @if($errors->has('alias'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alias') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.segmentConnected.fields.alias_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="site_point_1_id">{{ trans('cruds.segmentConnected.fields.site_point_1') }}</label>
                <select class="form-control select2 {{ $errors->has('site_point_1') ? 'is-invalid' : '' }}" name="site_point_1_id" id="site_point_1_id" required>
                    @foreach($site_point_1s as $id => $entry)
                        <option value="{{ $id }}" {{ old('site_point_1_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('site_point_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('site_point_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.segmentConnected.fields.site_point_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="site_point_2_id">{{ trans('cruds.segmentConnected.fields.site_point_2') }}</label>
                <select class="form-control select2 {{ $errors->has('site_point_2') ? 'is-invalid' : '' }}" name="site_point_2_id" id="site_point_2_id">
                    @foreach($site_point_2s as $id => $entry)
                        <option value="{{ $id }}" {{ old('site_point_2_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('site_point_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('site_point_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.segmentConnected.fields.site_point_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_core">{{ trans('cruds.segmentConnected.fields.total_core') }}</label>
                <input class="form-control {{ $errors->has('total_core') ? 'is-invalid' : '' }}" type="number" name="total_core" id="total_core" value="{{ old('total_core', '1') }}" step="1" required>
                @if($errors->has('total_core'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_core') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.segmentConnected.fields.total_core_helper') }}</span>
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