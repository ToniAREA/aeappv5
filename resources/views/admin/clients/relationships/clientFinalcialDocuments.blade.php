<div class="m-3">
    @can('finalcial_document_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.finalcial-documents.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.finalcialDocument.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.finalcialDocument.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-clientFinalcialDocuments">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.doc_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.reference_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.lastname') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.issue_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.due_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.currency') }}
                            </th>
                            <th>
                                {{ trans('cruds.currency.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.subtotal') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.total_taxes') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.total_discounts') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.total_amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.payment_terms') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.security_code') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.notes') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finalcialDocuments as $key => $finalcialDocument)
                            <tr data-entry-id="{{ $finalcialDocument->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $finalcialDocument->id ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\FinalcialDocument::DOC_TYPE_RADIO[$finalcialDocument->doc_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->reference_number ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\FinalcialDocument::STATUS_RADIO[$finalcialDocument->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->client->lastname ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->issue_date ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->due_date ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->currency->code ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->currency->name ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->subtotal ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->total_taxes ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->total_discounts ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->total_amount ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->payment_terms ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->security_code ?? '' }}
                                </td>
                                <td>
                                    {{ $finalcialDocument->notes ?? '' }}
                                </td>
                                <td>
                                    @can('finalcial_document_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.finalcial-documents.show', $finalcialDocument->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('finalcial_document_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.finalcial-documents.edit', $finalcialDocument->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('finalcial_document_delete')
                                        <form action="{{ route('admin.finalcial-documents.destroy', $finalcialDocument->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('finalcial_document_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.finalcial-documents.massDestroy') }}",
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
  let table = $('.datatable-clientFinalcialDocuments:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection