@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.iotDevice.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('iot_device_create')
                            <span>
                                <a class="btn btn-success" href="{{ route('frontend.iot-devices.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.iotDevice.title_singular') }}
                                </a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'IotDevice',
                                    'route' => 'admin.iot-devices.parseCsvImport',
                                ])
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-IotDevice">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.iotDevice.fields.id') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.is_active') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.name') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.device') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.product') }}</th>
                                        <th>{{ trans('cruds.product.fields.model') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.security_token') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.serial_number') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.status') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.additional_info') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.source_code_link') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.notes') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.internal_notes') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.link') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.link_name') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($iotDevices as $key => $iotDevice)
                                        <tr data-entry-id="{{ $iotDevice->id }}">
                                            <td style="text-align: center">{{ $iotDevice->id ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $iotDevice->is_active ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $iotDevice->is_active ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $iotDevice->name ?? '' }}</td>
                                            <td>{{ $iotDevice->device ?? '' }}</td>
                                            <td>{{ $iotDevice->product->name ?? '' }}</td>
                                            <td>{{ $iotDevice->product->model ?? '' }}</td>
                                            <td>{{ $iotDevice->security_token ?? '' }}</td>
                                            <td>{{ $iotDevice->serial_number ?? '' }}</td>
                                            <td>{{ App\Models\IotDevice::STATUS_RADIO[$iotDevice->status] ?? '' }}</td>
                                            <td>{{ $iotDevice->additional_info ?? '' }}</td>
                                            <td>{{ $iotDevice->source_code_link ?? '' }}</td>
                                            <td>{{ $iotDevice->notes ?? '' }}</td>
                                            <td>{{ $iotDevice->internal_notes ?? '' }}</td>
                                            <td>{{ $iotDevice->link ?? '' }}</td>
                                            <td>{{ $iotDevice->link_name ?? '' }}</td>
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
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            });
            let table = $('.datatable-IotDevice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            
        })
    </script>
@endsection