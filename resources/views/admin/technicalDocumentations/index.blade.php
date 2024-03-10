@extends('layouts.admin')
@section('content')
@can('technical_documentation_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.technical-documentations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.technicalDocumentation.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'TechnicalDocumentation', 'route' => 'admin.technical-documentations.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.technicalDocumentation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-TechnicalDocumentation">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.show_online') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.file') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.doc_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.brand') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.product.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.image') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.seo_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.seo_meta_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.seo_slug') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.authorized_roles') }}
                    </th>
                    <th>
                        {{ trans('cruds.technicalDocumentation.fields.authorized_users') }}
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
@can('technical_documentation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.technical-documentations.massDestroy') }}",
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
    ajax: "{{ route('admin.technical-documentations.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'show_online', name: 'show_online' },
{ data: 'description', name: 'description' },
{ data: 'file', name: 'file', sortable: false, searchable: false },
{ data: 'doc_type_name', name: 'doc_type.name' },
{ data: 'brand_brand', name: 'brand.brand' },
{ data: 'product_model', name: 'product.model' },
{ data: 'product.name', name: 'product.name' },
{ data: 'image', name: 'image', sortable: false, searchable: false },
{ data: 'seo_title', name: 'seo_title' },
{ data: 'seo_meta_description', name: 'seo_meta_description' },
{ data: 'seo_slug', name: 'seo_slug' },
{ data: 'authorized_roles', name: 'authorized_roles.title' },
{ data: 'authorized_users', name: 'authorized_users.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-TechnicalDocumentation').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection