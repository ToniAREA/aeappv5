<div class="m-3">
    @can('wlist_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.wlists.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.wlist.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.wlist.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-boatWlists">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.lastname') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.order_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.boat') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.boat_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.from_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.for_role') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.for_employee') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.namecomplete') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.boat_namecomplete') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.estimated_hours') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.photos') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.deadline') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.priority') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.proforma_link') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.internal_notes') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.link') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.link_description') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.last_use') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.completed_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.wlist.fields.financial_document') }}
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
                        @foreach($wlists as $key => $wlist)
                            <tr data-entry-id="{{ $wlist->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $wlist->id ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->client->lastname ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Wlist::ORDER_TYPE_RADIO[$wlist->order_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->boat->name ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->boat->boat_type ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->from_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->from_user->email ?? '' }}
                                </td>
                                <td>
                                    @foreach($wlist->for_roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $wlist->for_employee->id_employee ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->for_employee->namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->boat_namecomplete ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->description ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->estimated_hours ?? '' }}
                                </td>
                                <td>
                                    @foreach($wlist->photos as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $wlist->deadline ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->status->name ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->priority ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->proforma_link ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->notes ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->internal_notes ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->link ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->link_description ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->last_use ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->completed_at ?? '' }}
                                </td>
                                <td>
                                    {{ $wlist->financial_document->reference_number ?? '' }}
                                </td>
                                <td>
                                    @if($wlist->financial_document)
                                        {{ $wlist->financial_document::DOC_TYPE_RADIO[$wlist->financial_document->doc_type] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @can('wlist_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.wlists.show', $wlist->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('wlist_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.wlists.edit', $wlist->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('wlist_delete')
                                        <form action="{{ route('admin.wlists.destroy', $wlist->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('wlist_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.wlists.massDestroy') }}",
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
  let table = $('.datatable-boatWlists:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection