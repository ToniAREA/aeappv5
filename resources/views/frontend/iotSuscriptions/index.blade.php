@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.iotSuscription.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('iot_suscription_create')
                            <span>
                                <a class="btn btn-success" href="{{ route('frontend.iot-suscriptions.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.iotSuscription.title_singular') }}
                                </a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'IotSuscription',
                                    'route' => 'admin.iot-suscriptions.parseCsvImport',
                                ])
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-IotSuscription">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.iotSuscription.fields.id') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.user') }}</th>
                                        <th>{{ trans('cruds.user.fields.email') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.is_active') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.client') }}</th>
                                        <th>{{ trans('cruds.client.fields.lastname') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.boats') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.plan') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.short_description') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.signed_contract') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.start_date') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.end_date') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.hourly_rate') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.hourly_rate_discount') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.material_discount') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.device') }}</th>
                                        <th>{{ trans('cruds.iotDevice.fields.serial_number') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.link') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.link_description') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.notes') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.internalnotes') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.completed_at') }}</th>
                                        <th>{{ trans('cruds.iotSuscription.fields.financial_document') }}</th>
                                        <th>{{ trans('cruds.finalcialDocument.fields.doc_type') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($iotSuscriptions as $iotSuscription)
                                        <tr data-entry-id="{{ $iotSuscription->id }}"
                                            onclick="window.location.href='{{ route('frontend.iot-suscriptions.show', $iotSuscription->id) }}'"
                                            style="cursor: pointer;">
                                            <td style="text-align: center">{{ $iotSuscription->id ?? '' }}</td>
                                            <td>{{ $iotSuscription->user->name ?? '' }}</td>
                                            <td>{{ $iotSuscription->user->email ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $iotSuscription->is_active ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $iotSuscription->is_active ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $iotSuscription->client->name ?? '' }}</td>
                                            <td>{{ $iotSuscription->client->lastname ?? '' }}</td>
                                            <td>
                                                @foreach ($iotSuscription->boats as $item)
                                                    <span>{{ $item->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $iotSuscription->plan->plan_name ?? '' }}</td>
                                            <td>{{ $iotSuscription->plan->short_description ?? '' }}</td>
                                            <td>
                                                @if ($iotSuscription->signed_contract)
                                                    <a href="{{ $iotSuscription->signed_contract->getUrl() }}"
                                                        target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $iotSuscription->start_date ?? '' }}</td>
                                            <td>{{ $iotSuscription->end_date ?? '' }}</td>
                                            <td>{{ $iotSuscription->hourly_rate ?? '' }}</td>
                                            <td>{{ $iotSuscription->hourly_rate_discount ?? '' }}</td>
                                            <td>{{ $iotSuscription->material_discount ?? '' }}</td>
                                            <td>{{ $iotSuscription->device->name ?? '' }}</td>
                                            <td>{{ $iotSuscription->device->serial_number ?? '' }}</td>
                                            <td>{{ $iotSuscription->link ?? '' }}</td>
                                            <td>{{ $iotSuscription->link_description ?? '' }}</td>
                                            <td>{{ $iotSuscription->notes ?? '' }}</td>
                                            <td>{{ $iotSuscription->internalnotes ?? '' }}</td>
                                            <td>{{ $iotSuscription->completed_at ?? '' }}</td>
                                            <td>{{ $iotSuscription->financial_document->reference_number ?? '' }}</td>
                                            <td>
                                                @if ($iotSuscription->financial_document)
                                                    {{ $iotSuscription->financial_document::DOC_TYPE_RADIO[$iotSuscription->financial_document->doc_type] ?? '' }}
                                                @endif
                                            </td>
                                            <td>
                                                @can('iot_suscription_show')
                                                    <a class="btn btn-xs btn-primary"
                                                        href="{{ route('frontend.iot-suscriptions.show', $iotSuscription->id) }}">
                                                        {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('iot_suscription_edit')
                                                    <a class="btn btn-xs btn-info"
                                                        href="{{ route('frontend.iot-suscriptions.edit', $iotSuscription->id) }}">
                                                        {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @can('iot_suscription_delete')
                                                    <form
                                                        action="{{ route('frontend.iot-suscriptions.destroy', $iotSuscription->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                        style="display: inline-block;">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="submit" class="btn btn-xs btn-danger"
                                                            value="{{ trans('global.delete') }}">
                                                    </form>
                                                @endcan

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
            let table = $('.datatable-IotSuscription:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })

        })
    </script>
@endsection
