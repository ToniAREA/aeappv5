@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.iotReceivedData.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.iot-received-datas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="device_id">{{ trans('cruds.iotReceivedData.fields.device') }}</label>
                <select class="form-control select2 {{ $errors->has('device') ? 'is-invalid' : '' }}" name="device_id" id="device_id">
                    @foreach($devices as $id => $entry)
                        <option value="{{ $id }}" {{ old('device_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('device'))
                    <span class="text-danger">{{ $errors->first('device') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotReceivedData.fields.device_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="security_token">{{ trans('cruds.iotReceivedData.fields.security_token') }}</label>
                <input class="form-control {{ $errors->has('security_token') ? 'is-invalid' : '' }}" type="text" name="security_token" id="security_token" value="{{ old('security_token', '') }}">
                @if($errors->has('security_token'))
                    <span class="text-danger">{{ $errors->first('security_token') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotReceivedData.fields.security_token_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="received_data">{{ trans('cruds.iotReceivedData.fields.received_data') }}</label>
                <textarea class="form-control {{ $errors->has('received_data') ? 'is-invalid' : '' }}" name="received_data" id="received_data">{{ old('received_data') }}</textarea>
                @if($errors->has('received_data'))
                    <span class="text-danger">{{ $errors->first('received_data') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotReceivedData.fields.received_data_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_voltage">{{ trans('cruds.iotReceivedData.fields.service_voltage') }}</label>
                <input class="form-control {{ $errors->has('service_voltage') ? 'is-invalid' : '' }}" type="number" name="service_voltage" id="service_voltage" value="{{ old('service_voltage', '') }}" step="0.01">
                @if($errors->has('service_voltage'))
                    <span class="text-danger">{{ $errors->first('service_voltage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotReceivedData.fields.service_voltage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="engine_1_voltage">{{ trans('cruds.iotReceivedData.fields.engine_1_voltage') }}</label>
                <input class="form-control {{ $errors->has('engine_1_voltage') ? 'is-invalid' : '' }}" type="number" name="engine_1_voltage" id="engine_1_voltage" value="{{ old('engine_1_voltage', '') }}" step="0.01">
                @if($errors->has('engine_1_voltage'))
                    <span class="text-danger">{{ $errors->first('engine_1_voltage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotReceivedData.fields.engine_1_voltage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="engine_2_voltage">{{ trans('cruds.iotReceivedData.fields.engine_2_voltage') }}</label>
                <input class="form-control {{ $errors->has('engine_2_voltage') ? 'is-invalid' : '' }}" type="number" name="engine_2_voltage" id="engine_2_voltage" value="{{ old('engine_2_voltage', '') }}" step="0.01">
                @if($errors->has('engine_2_voltage'))
                    <span class="text-danger">{{ $errors->first('engine_2_voltage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotReceivedData.fields.engine_2_voltage_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('bilge_alarm') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="bilge_alarm" value="0">
                    <input class="form-check-input" type="checkbox" name="bilge_alarm" id="bilge_alarm" value="1" {{ old('bilge_alarm', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="bilge_alarm">{{ trans('cruds.iotReceivedData.fields.bilge_alarm') }}</label>
                </div>
                @if($errors->has('bilge_alarm'))
                    <span class="text-danger">{{ $errors->first('bilge_alarm') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotReceivedData.fields.bilge_alarm_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('shore_alarm') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="shore_alarm" value="0">
                    <input class="form-check-input" type="checkbox" name="shore_alarm" id="shore_alarm" value="1" {{ old('shore_alarm', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="shore_alarm">{{ trans('cruds.iotReceivedData.fields.shore_alarm') }}</label>
                </div>
                @if($errors->has('shore_alarm'))
                    <span class="text-danger">{{ $errors->first('shore_alarm') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.iotReceivedData.fields.shore_alarm_helper') }}</span>
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