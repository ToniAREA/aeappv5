@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('employee_attendance_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.employee-attendances.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.employeeAttendance.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.employeeAttendance.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-EmployeeAttendance">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.employeeAttendance.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeeAttendance.fields.employee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.namecomplete') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeeAttendance.fields.date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeeAttendance.fields.arrival_time') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employeeAttendance.fields.departure_time') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employeeAttendances as $key => $employeeAttendance)
                                    <tr data-entry-id="{{ $employeeAttendance->id }}">
                                        <td>
                                            {{ $employeeAttendance->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeeAttendance->employee->id_employee ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeeAttendance->employee->namecomplete ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeeAttendance->date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeeAttendance->arrival_time ?? '' }}
                                        </td>
                                        <td>
                                            {{ $employeeAttendance->departure_time ?? '' }}
                                        </td>
                                        <td>
                                            @can('employee_attendance_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.employee-attendances.show', $employeeAttendance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('employee_attendance_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.employee-attendances.edit', $employeeAttendance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('employee_attendance_delete')
                                                <form action="{{ route('frontend.employee-attendances.destroy', $employeeAttendance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('employee_attendance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.employee-attendances.massDestroy') }}",
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
  let table = $('.datatable-EmployeeAttendance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection