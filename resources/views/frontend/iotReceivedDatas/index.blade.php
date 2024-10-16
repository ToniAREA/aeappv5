@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.iotReceivedData.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('iot_received_data_create')
                            <span>
                                <a class="btn btn-success" href="{{ route('frontend.iot-received-datas.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.iotReceivedData.title_singular') }}
                                </a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'IotReceivedData',
                                    'route' => 'admin.iot-received-datas.parseCsvImport',
                                ])
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-IotReceivedData">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.iotReceivedData.fields.id') }}</th>
                                        <th>{{ trans('cruds.iotReceivedData.fields.device') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.status') }}</th>
                                        <th>{{ trans('cruds.iotReceivedData.fields.security_token') }}</th>
                                        <th>{{ trans('cruds.iotReceivedData.fields.received_data') }}</th>
                                        <th>{{ trans('cruds.iotReceivedData.fields.service_voltage') }}</th>
                                        <th>{{ trans('cruds.iotReceivedData.fields.engine_1_voltage') }}</th>
                                        <th>{{ trans('cruds.iotReceivedData.fields.engine_2_voltage') }}</th>
                                        <th>{{ trans('cruds.iotReceivedData.fields.bilge_alarm') }}</th>
                                        <th>{{ trans('cruds.iotReceivedData.fields.shore_alarm') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($iotReceivedDatas as $iotReceivedData)
                                        <tr data-entry-id="{{ $iotReceivedData->id }}">
                                            <td style="text-align: center">{{ $iotReceivedData->id ?? '' }}</td>
                                            <td>{{ $iotReceivedData->device->name ?? '' }}</td>
                                            <td>
                                                @if ($iotReceivedData->device)
                                                    {{ $iotReceivedData->device::STATUS_RADIO[$iotReceivedData->device->status] ?? '' }}
                                                @endif
                                            </td>
                                            <td>{{ $iotReceivedData->security_token ?? '' }}</td>
                                            <td>{{ $iotReceivedData->received_data ?? '' }}</td>
                                            <td>{{ $iotReceivedData->service_voltage ?? '' }}</td>
                                            <td>{{ $iotReceivedData->engine_1_voltage ?? '' }}</td>
                                            <td>{{ $iotReceivedData->engine_2_voltage ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $iotReceivedData->bilge_alarm ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $iotReceivedData->bilge_alarm ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <span style="display:none">{{ $iotReceivedData->shore_alarm ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $iotReceivedData->shore_alarm ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
            });
            let table = $('.datatable-IotReceivedData:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })

        })
    </script>
@endsection
