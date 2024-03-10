@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.iotDevice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.iot-devices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.id') }}
                        </th>
                        <td>
                            {{ $iotDevice->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.name') }}
                        </th>
                        <td>
                            {{ $iotDevice->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.device') }}
                        </th>
                        <td>
                            {{ $iotDevice->device }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $iotDevice->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.product') }}
                        </th>
                        <td>
                            {{ $iotDevice->product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.security_token') }}
                        </th>
                        <td>
                            {{ $iotDevice->security_token }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.serial_number') }}
                        </th>
                        <td>
                            {{ $iotDevice->serial_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\IotDevice::STATUS_RADIO[$iotDevice->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.additional_info') }}
                        </th>
                        <td>
                            {{ $iotDevice->additional_info }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.source_code_link') }}
                        </th>
                        <td>
                            {{ $iotDevice->source_code_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.notes') }}
                        </th>
                        <td>
                            {{ $iotDevice->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $iotDevice->internal_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.link') }}
                        </th>
                        <td>
                            {{ $iotDevice->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.iotDevice.fields.link_name') }}
                        </th>
                        <td>
                            {{ $iotDevice->link_name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.iot-devices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#device_iot_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.iotSuscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#device_iot_received_datas" role="tab" data-toggle="tab">
                {{ trans('cruds.iotReceivedData.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="device_iot_suscriptions">
            @includeIf('admin.iotDevices.relationships.deviceIotSuscriptions', ['iotSuscriptions' => $iotDevice->deviceIotSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="device_iot_received_datas">
            @includeIf('admin.iotDevices.relationships.deviceIotReceivedDatas', ['iotReceivedDatas' => $iotDevice->deviceIotReceivedDatas])
        </div>
    </div>
</div>

@endsection