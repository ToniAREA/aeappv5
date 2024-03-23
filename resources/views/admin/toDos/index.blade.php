@extends('layouts.admin')
@section('content')
@can('to_do_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.to-dos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.toDo.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ToDo', 'route' => 'admin.to-dos.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.toDo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ToDo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.task') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.photos') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.for_role') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.for_employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.namecomplete') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.deadline') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.priority') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.is_repetitive') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.repeat_interval_value') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.repeat_interval_unit') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.internal_notes') }}
                        </th>
                        <th>
                            {{ trans('cruds.toDo.fields.completed_at') }}
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($roles as $key => $item)
                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\ToDo::REPEAT_INTERVAL_UNIT_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
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
                    @foreach($toDos as $key => $toDo)
                        <tr data-entry-id="{{ $toDo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $toDo->id ?? '' }}
                            </td>
                            <td>
                                {{ $toDo->task ?? '' }}
                            </td>
                            <td>
                                @foreach($toDo->photos as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach($toDo->for_roles as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $toDo->for_employee->id_employee ?? '' }}
                            </td>
                            <td>
                                {{ $toDo->for_employee->namecomplete ?? '' }}
                            </td>
                            <td>
                                {{ $toDo->deadline ?? '' }}
                            </td>
                            <td>
                                {{ $toDo->priority ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $toDo->is_repetitive ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $toDo->is_repetitive ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $toDo->repeat_interval_value ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\ToDo::REPEAT_INTERVAL_UNIT_SELECT[$toDo->repeat_interval_unit] ?? '' }}
                            </td>
                            <td>
                                {{ $toDo->internal_notes ?? '' }}
                            </td>
                            <td>
                                {{ $toDo->completed_at ?? '' }}
                            </td>
                            <td>
                                @can('to_do_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.to-dos.show', $toDo->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('to_do_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.to-dos.edit', $toDo->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('to_do_delete')
                                    <form action="{{ route('admin.to-dos.destroy', $toDo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('to_do_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.to-dos.massDestroy') }}",
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
  let table = $('.datatable-ToDo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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