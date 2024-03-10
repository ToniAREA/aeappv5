@extends('layouts.admin')
@section('content')
@can('iot_device_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.iot-devices.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.iotDevice.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'IotDevice', 'route' => 'admin.iot-devices.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.iotDevice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-IotDevice">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.device') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.is_active') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.model') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.security_token') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.serial_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.additional_info') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.source_code_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.internal_notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotDevice.fields.link_name') }}
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
@can('iot_device_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.iot-devices.massDestroy') }}",
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
    ajax: "{{ route('admin.iot-devices.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'device', name: 'device' },
{ data: 'is_active', name: 'is_active' },
{ data: 'product_name', name: 'product.name' },
{ data: 'product.model', name: 'product.model' },
{ data: 'security_token', name: 'security_token' },
{ data: 'serial_number', name: 'serial_number' },
{ data: 'status', name: 'status' },
{ data: 'additional_info', name: 'additional_info' },
{ data: 'source_code_link', name: 'source_code_link' },
{ data: 'notes', name: 'notes' },
{ data: 'internal_notes', name: 'internal_notes' },
{ data: 'link', name: 'link' },
{ data: 'link_name', name: 'link_name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-IotDevice').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection