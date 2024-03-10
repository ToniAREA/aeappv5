@extends('layouts.admin')
@section('content')
@can('employee_holiday_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employee-holidays.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employeeHoliday.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'EmployeeHoliday', 'route' => 'admin.employee-holidays.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.employeeHoliday.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-EmployeeHoliday">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.employee') }}
                    </th>
                    <th>
                        {{ trans('cruds.employee.fields.namecomplete') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.end_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.days_taken') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.is_completed') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.employeeHoliday.fields.internalnotes') }}
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
@can('employee_holiday_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employee-holidays.massDestroy') }}",
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
    ajax: "{{ route('admin.employee-holidays.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'employee_id_employee', name: 'employee.id_employee' },
{ data: 'employee.namecomplete', name: 'employee.namecomplete' },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'days_taken', name: 'days_taken' },
{ data: 'is_completed', name: 'is_completed' },
{ data: 'type', name: 'type' },
{ data: 'notes', name: 'notes' },
{ data: 'internalnotes', name: 'internalnotes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-EmployeeHoliday').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection