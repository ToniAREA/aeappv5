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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-EmployeeHoliday">
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
                <tbody>
                    @foreach($employeeHolidays as $key => $employeeHoliday)
                        <tr data-entry-id="{{ $employeeHoliday->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $employeeHoliday->id ?? '' }}
                            </td>
                            <td>
                                {{ $employeeHoliday->employee->id_employee ?? '' }}
                            </td>
                            <td>
                                {{ $employeeHoliday->employee->namecomplete ?? '' }}
                            </td>
                            <td>
                                {{ $employeeHoliday->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $employeeHoliday->end_date ?? '' }}
                            </td>
                            <td>
                                {{ $employeeHoliday->days_taken ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $employeeHoliday->is_completed ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $employeeHoliday->is_completed ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $employeeHoliday->type ?? '' }}
                            </td>
                            <td>
                                {{ $employeeHoliday->notes ?? '' }}
                            </td>
                            <td>
                                {{ $employeeHoliday->internalnotes ?? '' }}
                            </td>
                            <td>
                                @can('employee_holiday_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.employee-holidays.show', $employeeHoliday->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('employee_holiday_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.employee-holidays.edit', $employeeHoliday->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('employee_holiday_delete')
                                    <form action="{{ route('admin.employee-holidays.destroy', $employeeHoliday->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('employee_holiday_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employee-holidays.massDestroy') }}",
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
  let table = $('.datatable-EmployeeHoliday:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection