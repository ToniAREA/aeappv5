@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('income_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.incomes.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.income.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Income', 'route' => 'admin.incomes.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.income.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Income">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.income.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.income.fields.is_accounted') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.income.fields.employee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.employee.fields.namecomplete') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.income.fields.income_category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.income.fields.entry_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.income.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.income.fields.amount') }}
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($income_categories as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
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
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($incomes as $key => $income)
                                    <tr data-entry-id="{{ $income->id }}">
                                        <td>
                                            {{ $income->id ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $income->is_accounted ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $income->is_accounted ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $income->employee->id_employee ?? '' }}
                                        </td>
                                        <td>
                                            {{ $income->employee->namecomplete ?? '' }}
                                        </td>
                                        <td>
                                            {{ $income->income_category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $income->entry_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $income->description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $income->amount ?? '' }}
                                        </td>
                                        <td>
                                            @can('income_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.incomes.show', $income->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('income_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.incomes.edit', $income->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('income_delete')
                                                <form action="{{ route('frontend.incomes.destroy', $income->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('income_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.incomes.massDestroy') }}",
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
  let table = $('.datatable-Income:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
})

</script>
@endsection