@extends('layouts.admin')
@section('content')
@can('financial_document_item_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.financial-document-items.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.financialDocumentItem.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'FinancialDocumentItem', 'route' => 'admin.financial-document-items.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.financialDocumentItem.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-FinancialDocumentItem">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('financial_document_item_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.financial-document-items.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.financial-document-items.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'financial_document_reference_number', name: 'financial_document.reference_number' },
{ data: 'financial_document.doc_type', name: 'financial_document.doc_type' },
{ data: 'product_model', name: 'product.model' },
{ data: 'product.name', name: 'product.name' },
{ data: 'description', name: 'description' },
{ data: 'quantity', name: 'quantity' },
{ data: 'unit_price', name: 'unit_price' },
{ data: 'line_position', name: 'line_position' },
{ data: 'subtotal', name: 'subtotal' },
{ data: 'total_amount', name: 'total_amount' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-FinancialDocumentItem').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection