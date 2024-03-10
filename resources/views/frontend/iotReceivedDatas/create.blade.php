@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.iotReceivedData.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.iot-received-datas.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="device_id">{{ trans('cruds.iotReceivedData.fields.device') }}</label>
                            <select class="form-control select2" name="device_id" id="device_id">
                                @foreach($devices as $id => $entry)
                                    <option value="{{ $id }}" {{ old('device_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('device'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('device') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.iotReceivedData.fields.device_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="security_token">{{ trans('cruds.iotReceivedData.fields.security_token') }}</label>
                            <input class="form-control" type="text" name="security_token" id="security_token" value="{{ old('security_token', '') }}">
                            @if($errors->has('security_token'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('security_token') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.iotReceivedData.fields.security_token_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="received_data">{{ trans('cruds.iotReceivedData.fields.received_data') }}</label>
                            <textarea class="form-control" name="received_data" id="received_data">{{ old('received_data') }}</textarea>
                            @if($errors->has('received_data'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('received_data') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.iotReceivedData.fields.received_data_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="service_voltage">{{ trans('cruds.iotReceivedData.fields.service_voltage') }}</label>
                            <input class="form-control" type="number" name="service_voltage" id="service_voltage" value="{{ old('service_voltage', '') }}" step="0.01">
                            @if($errors->has('service_voltage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('service_voltage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.iotReceivedData.fields.service_voltage_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="engine_1_voltage">{{ trans('cruds.iotReceivedData.fields.engine_1_voltage') }}</label>
                            <input class="form-control" type="number" name="engine_1_voltage" id="engine_1_voltage" value="{{ old('engine_1_voltage', '') }}" step="0.01">
                            @if($errors->has('engine_1_voltage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('engine_1_voltage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.iotReceivedData.fields.engine_1_voltage_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="engine_2_voltage">{{ trans('cruds.iotReceivedData.fields.engine_2_voltage') }}</label>
                            <input class="form-control" type="number" name="engine_2_voltage" id="engine_2_voltage" value="{{ old('engine_2_voltage', '') }}" step="0.01">
                            @if($errors->has('engine_2_voltage'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('engine_2_voltage') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.iotReceivedData.fields.engine_2_voltage_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="bilge_alarm" value="0">
                                <input type="checkbox" name="bilge_alarm" id="bilge_alarm" value="1" {{ old('bilge_alarm', 0) == 1 ? 'checked' : '' }}>
                                <label for="bilge_alarm">{{ trans('cruds.iotReceivedData.fields.bilge_alarm') }}</label>
                            </div>
                            @if($errors->has('bilge_alarm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bilge_alarm') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.iotReceivedData.fields.bilge_alarm_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="shore_alarm" value="0">
                                <input type="checkbox" name="shore_alarm" id="shore_alarm" value="1" {{ old('shore_alarm', 0) == 1 ? 'checked' : '' }}>
                                <label for="shore_alarm">{{ trans('cruds.iotReceivedData.fields.shore_alarm') }}</label>
                            </div>
                            @if($errors->has('shore_alarm'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('shore_alarm') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection