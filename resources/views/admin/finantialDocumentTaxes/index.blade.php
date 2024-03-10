@extends('layouts.admin')
@section('content')
@can('finantial_document_tax_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.finantial-document-taxes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.finantialDocumentTax.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'FinantialDocumentTax', 'route' => 'admin.finantial-document-taxes.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.finantialDocumentTax.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-FinantialDocumentTax">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.finantialDocumentTax.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.finantialDocumentTax.fields.item') }}
                    </th>
                    <th>
                        {{ trans('cruds.financialDocumentItem.fields.subtotal') }}
                    </th>
                    <th>
                        {{ trans('cruds.finantialDocumentTax.fields.tax_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.finantialDocumentTax.fields.tax_rate') }}
                    </th>
                    <th>
                        {{ trans('cruds.finantialDocumentTax.fields.tax_amount') }}
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
@can('finantial_document_tax_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.finantial-document-taxes.massDestroy') }}",
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
    ajax: "{{ route('admin.finantial-document-taxes.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'item_description', name: 'item.description' },
{ data: 'item.subtotal', name: 'item.subtotal' },
{ data: 'tax_type', name: 'tax_type' },
{ data: 'tax_rate', name: 'tax_rate' },
{ data: 'tax_amount', name: 'tax_amount' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-FinantialDocumentTax').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection