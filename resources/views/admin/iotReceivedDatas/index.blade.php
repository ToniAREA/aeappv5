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
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-IotReceivedData">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('iot_received_data_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.iot-received-datas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.iot-received-datas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'device_name', name: 'device.name' },
{ data: 'device.status', name: 'device.status' },
{ data: 'security_token', name: 'security_token' },
{ data: 'received_data', name: 'received_data' },
{ data: 'service_voltage', name: 'service_voltage' },
{ data: 'engine_1_voltage', name: 'engine_1_voltage' },
{ data: 'engine_2_voltage', name: 'engine_2_voltage' },
{ data: 'bilge_alarm', name: 'bilge_alarm' },
{ data: 'shore_alarm', name: 'shore_alarm' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-IotReceivedData').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection