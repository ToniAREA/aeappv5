<div class="m-3">
    @can('financial_document_item_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.financial-document-items.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.financialDocumentItem.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.financialDocumentItem.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-financialDocumentFinancialDocumentItems">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.financial_document') }}
                            </th>
                            <th>
                                {{ trans('cruds.finalcialDocument.fields.doc_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.product') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.quantity') }}
                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.unit_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.line_position') }}
                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.subtotal') }}
                            </th>
                            <th>
                                {{ trans('cruds.financialDocumentItem.fields.total_amount') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($financialDocumentItems as $key => $financialDocumentItem)
                            <tr data-entry-id="{{ $financialDocumentItem->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $financialDocumentItem->id ?? '' }}
                                </td>
                                <td>
                                    {{ $financialDocumentItem->financial_document->reference_number ?? '' }}
                                </td>
                                <td>
                                    @if($financialDocumentItem->financial_document)
                                        {{ $financialDocumentItem->financial_document::DOC_TYPE_RADIO[$financialDocumentItem->financial_document->doc_type] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    {{ $financialDocumentItem->product->model ?? '' }}
                                </td>
                                <td>
                                    {{ $financialDocumentItem->product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $financialDocumentItem->description ?? '' }}
                                </td>
                                <td>
                                    {{ $financialDocumentItem->quantity ?? '' }}
                                </td>
                                <td>
                                    {{ $financialDocumentItem->unit_price ?? '' }}
                                </td>
                                <td>
                                    {{ $financialDocumentItem->line_position ?? '' }}
                                </td>
                                <td>
                                    {{ $financialDocumentItem->subtotal ?? '' }}
                                </td>
                                <td>
                                    {{ $financialDocumentItem->total_amount ?? '' }}
                                </td>
                                <td>
                                    @can('financial_document_item_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.financial-document-items.show', $financialDocumentItem->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('financial_document_item_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.financial-document-items.edit', $financialDocumentItem->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('financial_document_item_delete')
                                        <form action="{{ route('admin.financial-document-items.destroy', $financialDocumentItem->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('financial_document_item_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.financial-document-items.massDestroy') }}",
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
  let table = $('.datatable-financialDocumentFinancialDocumentItems:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection