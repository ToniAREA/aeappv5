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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-FinantialDocumentTax">
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
                <tbody>
                    @foreach($finantialDocumentTaxes as $key => $finantialDocumentTax)
                        <tr data-entry-id="{{ $finantialDocumentTax->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $finantialDocumentTax->id ?? '' }}
                            </td>
                            <td>
                                {{ $finantialDocumentTax->item->description ?? '' }}
                            </td>
                            <td>
                                {{ $finantialDocumentTax->item->subtotal ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\FinantialDocumentTax::TAX_TYPE_RADIO[$finantialDocumentTax->tax_type] ?? '' }}
                            </td>
                            <td>
                                {{ $finantialDocumentTax->tax_rate ?? '' }}
                            </td>
                            <td>
                                {{ $finantialDocumentTax->tax_amount ?? '' }}
                            </td>
                            <td>
                                @can('finantial_document_tax_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.finantial-document-taxes.show', $finantialDocumentTax->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('finantial_document_tax_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.finantial-document-taxes.edit', $finantialDocumentTax->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('finantial_document_tax_delete')
                                    <form action="{{ route('admin.finantial-document-taxes.destroy', $finantialDocumentTax->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('finantial_document_tax_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.finantial-document-taxes.massDestroy') }}",
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
  let table = $('.datatable-FinantialDocumentTax:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection