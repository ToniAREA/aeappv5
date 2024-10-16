@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.iotDevice.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.iot-devices.store') }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <div>
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" id="is_active" value="1"
                                        {{ old('is_active', 0) == 1 ? 'checked' : '' }}>
                                    <label for="is_active">{{ trans('cruds.iotDevice.fields.is_active') }}</label>
                                </div>
                                @if ($errors->has('is_active'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('is_active') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.is_active_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="name">{{ trans('cruds.iotDevice.fields.name') }}</label>
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ old('name', '') }}" required>
                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="device">{{ trans('cruds.iotDevice.fields.device') }}</label>
                                <input class="form-control" type="text" name="device" id="device"
                                    value="{{ old('device', '') }}">
                                @if ($errors->has('device'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('device') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.device_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="product_id">{{ trans('cruds.iotDevice.fields.product') }}</label>
                                <select class="form-control select2" name="product_id" id="product_id">
                                    @foreach ($products as $id => $entry)
                                        <option value="{{ $id }}"
                                            {{ old('product_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('product') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.product_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="security_token">{{ trans('cruds.iotDevice.fields.security_token') }}</label>
                                <input class="form-control" type="text" name="security_token" id="security_token"
                                    value="{{ old('security_token', '') }}">
                                @if ($errors->has('security_token'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('security_token') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.security_token_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="serial_number">{{ trans('cruds.iotDevice.fields.serial_number') }}</label>
                                <input class="form-control" type="text" name="serial_number" id="serial_number"
                                    value="{{ old('serial_number', '') }}">
                                @if ($errors->has('serial_number'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('serial_number') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.serial_number_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label>{{ trans('cruds.iotDevice.fields.status') }}</label>
                                @foreach (App\Models\IotDevice::STATUS_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="status_{{ $key }}" name="status"
                                            value="{{ $key }}"
                                            {{ old('status', 'available') === (string) $key ? 'checked' : '' }}>
                                        <label for="status_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.status_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="additional_info">{{ trans('cruds.iotDevice.fields.additional_info') }}</label>
                                <textarea class="form-control" name="additional_info" id="additional_info">{{ old('additional_info') }}</textarea>
                                @if ($errors->has('additional_info'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('additional_info') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotDevice.fields.additional_info_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="source_code_link">{{ trans('cruds.iotDevice.fields.source_code_link') }}</label>
                                <input class="form-control" type="text" name="source_code_link" id="source_code_link"
                                    value="{{ old('source_code_link', '') }}">
                                @if ($errors->has('source_code_link'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('source_code_link') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotDevice.fields.source_code_link_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="notes">{{ trans('cruds.iotDevice.fields.notes') }}</label>
                                <input class="form-control" type="text" name="notes" id="notes"
                                    value="{{ old('notes', '') }}">
                                @if ($errors->has('notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('notes') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.notes_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="internal_notes">{{ trans('cruds.iotDevice.fields.internal_notes') }}</label>
                                <input class="form-control" type="text" name="internal_notes" id="internal_notes"
                                    value="{{ old('internal_notes', '') }}">
                                @if ($errors->has('internal_notes'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('internal_notes') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.iotDevice.fields.internal_notes_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="link">{{ trans('cruds.iotDevice.fields.link') }}</label>
                                <input class="form-control" type="text" name="link" id="link"
                                    value="{{ old('link', '') }}">
                                @if ($errors->has('link'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('link') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.iotDevice.fields.link_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="link_name">{{ trans('cruds.iotDevice.fields.link_name') }}</label>
                                <input class="form-control" type="text" name="link_name" id="link_name"
                                    value="{{ old('link_name', '') }}">
                                @if ($errors->has('link_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('link_name') }}
                                    </div>
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

            </div>
        </div>
    </div>
@endsection
