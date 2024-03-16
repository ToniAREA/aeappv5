<div class="m-3">
    @can('employee_rating_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.employee-ratings.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.employeeRating.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.employeeRating.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-fromClientEmployeeRatings">
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
                    <tbody>
                        @foreach($employeeRatings as $key => $employeeRating)
                            <tr data-entry-id="{{ $employeeRating->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $employeeRating->id ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->employee->id_employee ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->employee->namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->from_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->from_user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->from_client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->from_client->lastname ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->for_wlist->boat_namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->for_wlist->description ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->for_wlog->date ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->for_wlog->boat_namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->rating ?? '' }}
                                </td>
                                <td>
                                    {{ $employeeRating->comment ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $employeeRating->show_online ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $employeeRating->show_online ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('employee_rating_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.employee-ratings.show', $employeeRating->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('employee_rating_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.employee-ratings.edit', $employeeRating->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('employee_rating_delete')
                                        <form action="{{ route('admin.employee-ratings.destroy', $employeeRating->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('employee_rating_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.employee-ratings.massDestroy') }}",
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
  let table = $('.datatable-fromClientEmployeeRatings:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection