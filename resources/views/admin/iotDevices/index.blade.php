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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-IotDevice">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.iotDevice.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotDevice.fields.is_active') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotDevice.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.iotDevice.fields.device') }}
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
                <tbody>
                    @foreach($iotDevices as $key => $iotDevice)
                        <tr data-entry-id="{{ $iotDevice->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $iotDevice->id ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $iotDevice->is_active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $iotDevice->is_active ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $iotDevice->name ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->device ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->product->name ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->product->model ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->security_token ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->serial_number ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\IotDevice::STATUS_RADIO[$iotDevice->status] ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->additional_info ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->source_code_link ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->notes ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->internal_notes ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->link ?? '' }}
                            </td>
                            <td>
                                {{ $iotDevice->link_name ?? '' }}
                            </td>
                            <td>
                                @can('iot_device_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.iot-devices.show', $iotDevice->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('iot_device_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.iot-devices.edit', $iotDevice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('iot_device_delete')
                                    <form action="{{ route('admin.iot-devices.destroy', $iotDevice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('iot_device_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.iot-devices.massDestroy') }}",
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
  let table = $('.datatable-IotDevice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection