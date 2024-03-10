@extends('layouts.admin')
@section('content')
@can('finalcial_document_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.finalcial-documents.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.finalcialDocument.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'FinalcialDocument', 'route' => 'admin.finalcial-documents.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.finalcialDocument.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-FinalcialDocument">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('finalcial_document_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.finalcial-documents.massDestroy') }}",
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
    ajax: "{{ route('admin.finalcial-documents.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'doc_type', name: 'doc_type' },
{ data: 'reference_number', name: 'reference_number' },
{ data: 'status', name: 'status' },
{ data: 'client_name', name: 'client.name' },
{ data: 'client.lastname', name: 'client.lastname' },
{ data: 'issue_date', name: 'issue_date' },
{ data: 'due_date', name: 'due_date' },
{ data: 'currency_code', name: 'currency.code' },
{ data: 'currency.name', name: 'currency.name' },
{ data: 'subtotal', name: 'subtotal' },
{ data: 'total_taxes', name: 'total_taxes' },
{ data: 'total_discounts', name: 'total_discounts' },
{ data: 'total_amount', name: 'total_amount' },
{ data: 'payment_terms', name: 'payment_terms' },
{ data: 'security_code', name: 'security_code' },
{ data: 'notes', name: 'notes' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-FinalcialDocument').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection