@extends('layouts.admin')
@section('content')
@can('documentation_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.documentations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.documentation.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Documentation', 'route' => 'admin.documentations.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.documentation.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Documentation">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentationCategory.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.expiration_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.is_valid') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.file') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.internal_notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.link_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.authorized_roles') }}
                    </th>
                    <th>
                        {{ trans('cruds.documentation.fields.authorized_users') }}
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
@can('documentation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.documentations.massDestroy') }}",
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
    ajax: "{{ route('admin.documentations.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'category_name', name: 'category.name' },
{ data: 'category.description', name: 'category.description' },
{ data: 'expiration_date', name: 'expiration_date' },
{ data: 'is_valid', name: 'is_valid' },
{ data: 'file', name: 'file', sortable: false, searchable: false },
{ data: 'notes', name: 'notes' },
{ data: 'internal_notes', name: 'internal_notes' },
{ data: 'link', name: 'link' },
{ data: 'link_description', name: 'link_description' },
{ data: 'authorized_roles', name: 'authorized_roles.title' },
{ data: 'authorized_users', name: 'authorized_users.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Documentation').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection