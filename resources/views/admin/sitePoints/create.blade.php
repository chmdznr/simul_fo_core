@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sitePoint.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.site-points.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="sid">{{ trans('cruds.sitePoint.fields.sid') }}</label>
                <input class="form-control {{ $errors->has('sid') ? 'is-invalid' : '' }}" type="text" name="sid" id="sid" value="{{ old('sid', '') }}" required>
                @if($errors->has('sid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.sid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="site_name">{{ trans('cruds.sitePoint.fields.site_name') }}</label>
                <input class="form-control {{ $errors->has('site_name') ? 'is-invalid' : '' }}" type="text" name="site_name" id="site_name" value="{{ old('site_name', '') }}" required>
                @if($errors->has('site_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('site_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.site_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="latitude">{{ trans('cruds.sitePoint.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number" name="latitude" id="latitude" value="{{ old('latitude', '') }}" step="0.0000000001" required>
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="longitude">{{ trans('cruds.sitePoint.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number" name="longitude" id="longitude" value="{{ old('longitude', '') }}" step="0.0000000001" required>
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.sitePoint.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kode_pos">{{ trans('cruds.sitePoint.fields.kode_pos') }}</label>
                <input class="form-control {{ $errors->has('kode_pos') ? 'is-invalid' : '' }}" type="text" name="kode_pos" id="kode_pos" value="{{ old('kode_pos', '') }}">
                @if($errors->has('kode_pos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kode_pos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.kode_pos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kelurahan">{{ trans('cruds.sitePoint.fields.kelurahan') }}</label>
                <input class="form-control {{ $errors->has('kelurahan') ? 'is-invalid' : '' }}" type="text" name="kelurahan" id="kelurahan" value="{{ old('kelurahan', '') }}">
                @if($errors->has('kelurahan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kelurahan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.kelurahan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kecamatan">{{ trans('cruds.sitePoint.fields.kecamatan') }}</label>
                <input class="form-control {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}" type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan', '') }}">
                @if($errors->has('kecamatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kecamatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.kecamatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kabupaten">{{ trans('cruds.sitePoint.fields.kabupaten') }}</label>
                <input class="form-control {{ $errors->has('kabupaten') ? 'is-invalid' : '' }}" type="text" name="kabupaten" id="kabupaten" value="{{ old('kabupaten', '') }}">
                @if($errors->has('kabupaten'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kabupaten') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.kabupaten_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provinsi">{{ trans('cruds.sitePoint.fields.provinsi') }}</label>
                <input class="form-control {{ $errors->has('provinsi') ? 'is-invalid' : '' }}" type="text" name="provinsi" id="provinsi" value="{{ old('provinsi', '') }}">
                @if($errors->has('provinsi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provinsi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.provinsi_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="region">{{ trans('cruds.sitePoint.fields.region') }}</label>
                <input class="form-control {{ $errors->has('region') ? 'is-invalid' : '' }}" type="text" name="region" id="region" value="{{ old('region', '') }}">
                @if($errors->has('region'))
                    <div class="invalid-feedback">
                        {{ $errors->first('region') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.region_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="area">{{ trans('cruds.sitePoint.fields.area') }}</label>
                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area" id="area" value="{{ old('area', '') }}">
                @if($errors->has('area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cluster">{{ trans('cruds.sitePoint.fields.cluster') }}</label>
                <input class="form-control {{ $errors->has('cluster') ? 'is-invalid' : '' }}" type="text" name="cluster" id="cluster" value="{{ old('cluster', '') }}">
                @if($errors->has('cluster'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cluster') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sitePoint.fields.cluster_helper') }}</span>
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