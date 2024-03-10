@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.iotDevice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.iot-devices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.iotDevice.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="device">{{ trans('cruds.iotDevice.fields.device') }}</label>
                <input class="form-control {{ $errors->has('device') ? 'is-invalid' : '' }}" type="text" name="device" id="device" value="{{ old('device', '') }}">
                @if($errors->has('device'))
                    <span class="text-danger">{{ $errors->first('device') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.device_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">{{ trans('cruds.iotDevice.fields.is_active') }}</label>
                </div>
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_id">{{ trans('cruds.iotDevice.fields.product') }}</label>
                <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
                    @foreach($products as $id => $entry)
                        <option value="{{ $id }}" {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product'))
                    <span class="text-danger">{{ $errors->first('product') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.product_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="security_token">{{ trans('cruds.iotDevice.fields.security_token') }}</label>
                <input class="form-control {{ $errors->has('security_token') ? 'is-invalid' : '' }}" type="text" name="security_token" id="security_token" value="{{ old('security_token', '') }}">
                @if($errors->has('security_token'))
                    <span class="text-danger">{{ $errors->first('security_token') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.security_token_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="serial_number">{{ trans('cruds.iotDevice.fields.serial_number') }}</label>
                <input class="form-control {{ $errors->has('serial_number') ? 'is-invalid' : '' }}" type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', '') }}">
                @if($errors->has('serial_number'))
                    <span class="text-danger">{{ $errors->first('serial_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.serial_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.iotDevice.fields.status') }}</label>
                @foreach(App\Models\IotDevice::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', 'available') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="additional_info">{{ trans('cruds.iotDevice.fields.additional_info') }}</label>
                <textarea class="form-control {{ $errors->has('additional_info') ? 'is-invalid' : '' }}" name="additional_info" id="additional_info">{{ old('additional_info') }}</textarea>
                @if($errors->has('additional_info'))
                    <span class="text-danger">{{ $errors->first('additional_info') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.additional_info_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="source_code_link">{{ trans('cruds.iotDevice.fields.source_code_link') }}</label>
                <input class="form-control {{ $errors->has('source_code_link') ? 'is-invalid' : '' }}" type="text" name="source_code_link" id="source_code_link" value="{{ old('source_code_link', '') }}">
                @if($errors->has('source_code_link'))
                    <span class="text-danger">{{ $errors->first('source_code_link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.source_code_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('cruds.iotDevice.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal_notes">{{ trans('cruds.iotDevice.fields.internal_notes') }}</label>
                <input class="form-control {{ $errors->has('internal_notes') ? 'is-invalid' : '' }}" type="text" name="internal_notes" id="internal_notes" value="{{ old('internal_notes', '') }}">
                @if($errors->has('internal_notes'))
                    <span class="text-danger">{{ $errors->first('internal_notes') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.internal_notes_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.iotDevice.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <span class="text-danger">{{ $errors->first('link') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_name">{{ trans('cruds.iotDevice.fields.link_name') }}</label>
                <input class="form-control {{ $errors->has('link_name') ? 'is-invalid' : '' }}" type="text" name="link_name" id="link_name" value="{{ old('link_name', '') }}">
                @if($errors->has('link_name'))
                    <span class="text-danger">{{ $errors->first('link_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotDevice.fields.link_name_helper') }}</span>
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