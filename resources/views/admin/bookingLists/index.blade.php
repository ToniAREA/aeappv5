@extends('layouts.admin')
@section('content')
@can('booking_list_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.booking-lists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bookingList.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'BookingList', 'route' => 'admin.booking-lists.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bookingList.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-BookingList">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.lastname') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.boat') }}
                    </th>
                    <th>
                        {{ trans('cruds.boat.fields.boat_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.employee') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.hours') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.start_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.end_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.hour_rate') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.total_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.internal_notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.confirmed') }}
                    </th>
                    <th>
                        {{ trans('cruds.bookingList.fields.status') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($clients as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($boats as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($employees as $key => $item)
                                <option value="{{ $item->id_employee }}">{{ $item->id_employee }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
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
@can('booking_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.booking-lists.massDestroy') }}",
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
    ajax: "{{ route('admin.booking-lists.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'client_name', name: 'client.name' },
{ data: 'client.lastname', name: 'client.lastname' },
{ data: 'boat_name', name: 'boat.name' },
{ data: 'boat.boat_type', name: 'boat.boat_type' },
{ data: 'employee_id_employee', name: 'employee.id_employee' },
{ data: 'employee.category', name: 'employee.category' },
{ data: 'date', name: 'date' },
{ data: 'hours', name: 'hours' },
{ data: 'start_time', name: 'start_time' },
{ data: 'end_time', name: 'end_time' },
{ data: 'hour_rate', name: 'hour_rate' },
{ data: 'total_price', name: 'total_price' },
{ data: 'notes', name: 'notes' },
{ data: 'internal_notes', name: 'internal_notes' },
{ data: 'confirmed', name: 'confirmed' },
{ data: 'status', name: 'status' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-BookingList').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection