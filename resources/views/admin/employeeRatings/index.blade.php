@extends('layouts.admin')
@section('content')
@can('employee_rating_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employee-ratings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employeeRating.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'EmployeeRating', 'route' => 'admin.employee-ratings.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.employeeRating.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-EmployeeRating">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.employee') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.namecomplete') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.from_user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.from_client') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.lastname') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.for_wlist') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlist.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.for_wlog') }}
                    </th>
                    <th>
                        {{ trans('cruds.wlog.fields.boat_namecomplete') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.rating') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.comment') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeRating.fields.show_online') }}
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
@can('employee_rating_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employee-ratings.massDestroy') }}",
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
    ajax: "{{ route('admin.employee-ratings.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'employee_id_employee', name: 'employee.id_employee' },
{ data: 'employee.namecomplete', name: 'employee.namecomplete' },
{ data: 'from_user_name', name: 'from_user.name' },
{ data: 'from_user.email', name: 'from_user.email' },
{ data: 'from_client_name', name: 'from_client.name' },
{ data: 'from_client.lastname', name: 'from_client.lastname' },
{ data: 'for_wlist_boat_namecomplete', name: 'for_wlist.boat_namecomplete' },
{ data: 'for_wlist.description', name: 'for_wlist.description' },
{ data: 'for_wlog_date', name: 'for_wlog.date' },
{ data: 'for_wlog.boat_namecomplete', name: 'for_wlog.boat_namecomplete' },
{ data: 'rating', name: 'rating' },
{ data: 'comment', name: 'comment' },
{ data: 'show_online', name: 'show_online' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-EmployeeRating').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection