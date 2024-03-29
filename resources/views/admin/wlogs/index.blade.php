@extends('layouts.admin')
@section('content')
@can('wlog_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.wlogs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.wlog.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Wlog', 'route' => 'admin.wlogs.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.wlog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Wlog">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.wlist') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.boat_namecomplete') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.marina') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.hours') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.hourly_rate') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.travel_cost_included') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.total_travel_cost') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.total_access_cost') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.wlist_finished') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.invoiced_line') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.notes') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.internal_notes') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.photos') }}
                        </th>
                        <th>
                            {{ trans('cruds.wlog.fields.financial_document') }}
                        </th>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.doc_type') }}
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
                                @foreach($wlists as $key => $item)
                                    <option value="{{ $item->description }}">{{ $item->description }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
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
                                @foreach($marinas as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                @foreach($finalcial_documents as $key => $item)
                                    <option value="{{ $item->reference_number }}">{{ $item->reference_number }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wlogs as $key => $wlog)
                        <tr data-entry-id="{{ $wlog->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $wlog->id ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->wlist->description ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->boat_namecomplete ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->date ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->employee->name ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->employee->email ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->marina->name ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->description ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->hours ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->hourly_rate ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $wlog->travel_cost_included ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $wlog->travel_cost_included ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $wlog->total_travel_cost ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->total_access_cost ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $wlog->wlist_finished ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $wlog->wlist_finished ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $wlog->invoiced_line ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $wlog->invoiced_line ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $wlog->notes ?? '' }}
                            </td>
                            <td>
                                {{ $wlog->internal_notes ?? '' }}
                            </td>
                            <td>
                                @foreach($wlog->photos as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $wlog->financial_document->reference_number ?? '' }}
                            </td>
                            <td>
                                @if($wlog->financial_document)
                                    {{ $wlog->financial_document::DOC_TYPE_RADIO[$wlog->financial_document->doc_type] ?? '' }}
                                @endif
                            </td>
                            <td>
                                @can('wlog_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.wlogs.show', $wlog->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('wlog_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.wlogs.edit', $wlog->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('wlog_delete')
                                    <form action="{{ route('admin.wlogs.destroy', $wlog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('wlog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.wlogs.massDestroy') }}",
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
  let table = $('.datatable-Wlog:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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