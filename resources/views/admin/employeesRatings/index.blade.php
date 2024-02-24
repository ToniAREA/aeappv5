@extends('layouts.admin')
@section('content')
@can('employees_rating_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.employees-ratings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.employeesRating.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.employeesRating.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-EmployeesRating">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.namecomplete') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.from_user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.from_client') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.lastname') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.for_wlist') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlist.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.for_wlog') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.boat_namecomplete') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.rating') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.comment') }}
                        </th>
                        <th>
                            {{ trans('cruds.employeesRating.fields.show_online') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employeesRatings as $key => $employeesRating)
                        <tr data-entry-id="{{ $employeesRating->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $employeesRating->id ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->employee->id_employee ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->employee->namecomplete ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->from_user->name ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->from_user->email ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->from_client->name ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->from_client->lastname ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->for_wlist->boat_namecomplete ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->for_wlist->description ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->for_wlog->date ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->for_wlog->boat_namecomplete ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->rating ?? '' }}
                            </td>
                            <td>
                                {{ $employeesRating->comment ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $employeesRating->show_online ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $employeesRating->show_online ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('employees_rating_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.employees-ratings.show', $employeesRating->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('employees_rating_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.employees-ratings.edit', $employeesRating->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('employees_rating_delete')
                                    <form action="{{ route('admin.employees-ratings.destroy', $employeesRating->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('employees_rating_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employees-ratings.massDestroy') }}",
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
  let table = $('.datatable-EmployeesRating:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection