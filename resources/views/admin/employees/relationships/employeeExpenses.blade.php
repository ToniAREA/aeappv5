<div class="m-3">
    @can('expense_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.expenses.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.expense.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.expense.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-employeeExpenses">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.is_accounted') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.employee') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.namecomplete') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.expense_category') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.entry_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.files') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.photos') }}
                            </th>
                            <th>
                                {{ trans('cruds.expense.fields.notes') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $key => $expense)
                            <tr data-entry-id="{{ $expense->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $expense->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $expense->is_accounted ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $expense->is_accounted ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $expense->employee->id_employee ?? '' }}
                                </td>
                                <td>
                                    {{ $expense->employee->namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $expense->expense_category->name ?? '' }}
                                </td>
                                <td>
                                    {{ $expense->entry_date ?? '' }}
                                </td>
                                <td>
                                    {{ $expense->description ?? '' }}
                                </td>
                                <td>
                                    {{ $expense->amount ?? '' }}
                                </td>
                                <td>
                                    @foreach($expense->files as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($expense->photos as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $expense->notes ?? '' }}
                                </td>
                                <td>
                                    @can('expense_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.expenses.show', $expense->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('expense_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.expenses.edit', $expense->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('expense_delete')
                                        <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('expense_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.expenses.massDestroy') }}",
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
  let table = $('.datatable-employeeExpenses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection