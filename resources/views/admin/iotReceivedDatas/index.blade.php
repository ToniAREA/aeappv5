@extends('layouts.admin')
@section('content')
@can('iot_received_data_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.iot-received-datas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.iotReceivedData.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'IotReceivedData', 'route' => 'admin.iot-received-datas.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.iotReceivedData.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-IotReceivedData">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.device') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotDevice.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.security_token') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.received_data') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.service_voltage') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.engine_1_voltage') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.engine_2_voltage') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.bilge_alarm') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotReceivedData.fields.shore_alarm') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($iotReceivedDatas as $key => $iotReceivedData)
                        <tr data-entry-id="{{ $iotReceivedData->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $iotReceivedData->id ?? '' }}
                            </td>
                            <td>
                                {{ $iotReceivedData->device->name ?? '' }}
                            </td>
                            <td>
                                @if($iotReceivedData->device)
                                    {{ $iotReceivedData->device::STATUS_RADIO[$iotReceivedData->device->status] ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $iotReceivedData->security_token ?? '' }}
                            </td>
                            <td>
                                {{ $iotReceivedData->received_data ?? '' }}
                            </td>
                            <td>
                                {{ $iotReceivedData->service_voltage ?? '' }}
                            </td>
                            <td>
                                {{ $iotReceivedData->engine_1_voltage ?? '' }}
                            </td>
                            <td>
                                {{ $iotReceivedData->engine_2_voltage ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $iotReceivedData->bilge_alarm ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $iotReceivedData->bilge_alarm ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $iotReceivedData->shore_alarm ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $iotReceivedData->shore_alarm ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('iot_received_data_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.iot-received-datas.show', $iotReceivedData->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('iot_received_data_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.iot-received-datas.edit', $iotReceivedData->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('iot_received_data_delete')
                                    <form action="{{ route('admin.iot-received-datas.destroy', $iotReceivedData->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('iot_received_data_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.iot-received-datas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-IotReceivedData:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection