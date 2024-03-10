@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.iotReceivedData.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.iot-received-datas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $iotReceivedData->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.device') }}
                                    </th>
                                    <td>
                                        {{ $iotReceivedData->device->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.security_token') }}
                                    </th>
                                    <td>
                                        {{ $iotReceivedData->security_token }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.received_data') }}
                                    </th>
                                    <td>
                                        {{ $iotReceivedData->received_data }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.service_voltage') }}
                                    </th>
                                    <td>
                                        {{ $iotReceivedData->service_voltage }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.engine_1_voltage') }}
                                    </th>
                                    <td>
                                        {{ $iotReceivedData->engine_1_voltage }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.engine_2_voltage') }}
                                    </th>
                                    <td>
                                        {{ $iotReceivedData->engine_2_voltage }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.bilge_alarm') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $iotReceivedData->bilge_alarm ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotReceivedData.fields.shore_alarm') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $iotReceivedData->shore_alarm ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.iot-received-datas.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection