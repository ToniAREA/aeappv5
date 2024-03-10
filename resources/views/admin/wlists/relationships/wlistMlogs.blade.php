<div class="m-3">
    @can('mlog_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.mlogs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.mlog.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.mlog.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-wlistMlogs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.boat') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.boat_namecomplete') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.wlist') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.employee') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.item') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.photos') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.units') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.price_unit') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.invoiced_line') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.internal_notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.mlog.fields.financial_document') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.doc_type') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mlogs as $key => $mlog)
                            <tr data-entry-id="{{ $mlog->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $mlog->id ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->boat->name ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->boat_namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->wlist->description ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->date ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->employee->name ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->employee->email ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->item ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->description ?? '' }}
                                </td>
                                <td>
                                    @foreach($mlog->photos as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $mlog->units ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->price_unit ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $mlog->invoiced_line ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $mlog->invoiced_line ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $mlog->internal_notes ?? '' }}
                                </td>
                                <td>
                                    {{ $mlog->financial_document->reference_number ?? '' }}
                                </td>
                                <td>
                                    @if($mlog->financial_document)
                                        {{ $mlog->financial_document::DOC_TYPE_RADIO[$mlog->financial_document->doc_type] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @can('mlog_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.mlogs.show', $mlog->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('mlog_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.mlogs.edit', $mlog->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('mlog_delete')
                                        <form action="{{ route('admin.mlogs.destroy', $mlog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('mlog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mlogs.massDestroy') }}",
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
  let table = $('.datatable-wlistMlogs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection