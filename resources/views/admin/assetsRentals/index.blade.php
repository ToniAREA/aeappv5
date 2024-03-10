@extends('layouts.admin')
@section('content')
@can('assets_rental_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.assets-rentals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.assetsRental.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'AssetsRental', 'route' => 'admin.assets-rentals.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.assetsRental.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AssetsRental">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.asset') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.data_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.lastname') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.boat') }}
                    </th>
                    <th>
                        {{ trans('cruds.boat.fields.boat_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.end_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.rental_details') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.active') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.invoiced') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.link_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.completed_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.rental_unit') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.rental_quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.assetsRental.fields.financial_document') }}
                    </th>
                    <th>
                        {{ trans('cruds.finalcialDocument.fields.doc_type') }}
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
@can('assets_rental_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assets-rentals.massDestroy') }}",
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
    ajax: "{{ route('admin.assets-rentals.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'asset_name', name: 'asset.name' },
{ data: 'asset.data_1', name: 'asset.data_1' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'client_name', name: 'client.name' },
{ data: 'client.lastname', name: 'client.lastname' },
{ data: 'boat_name', name: 'boat.name' },
{ data: 'boat.boat_type', name: 'boat.boat_type' },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'rental_details', name: 'rental_details' },
{ data: 'active', name: 'active' },
{ data: 'invoiced', name: 'invoiced' },
{ data: 'link', name: 'link' },
{ data: 'link_description', name: 'link_description' },
{ data: 'completed_at', name: 'completed_at' },
{ data: 'rental_unit', name: 'rental_unit' },
{ data: 'rental_quantity', name: 'rental_quantity' },
{ data: 'financial_document_reference_number', name: 'financial_document.reference_number' },
{ data: 'financial_document.doc_type', name: 'financial_document.doc_type' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AssetsRental').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection