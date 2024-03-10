@extends('layouts.admin')
@section('content')
@can('asset_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.assets.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.asset.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Asset', 'route' => 'admin.assets.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.asset.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Asset">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.photos') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.available') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.location') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.actual_holder') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.internal_notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.data_1') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.data_1_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.data_2') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.data_2_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.files') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.link_a') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.link_a_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.link_b') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.link_b_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.last_use') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($asset_categories as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($asset_statuses as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($asset_locations as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
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
@can('asset_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assets.massDestroy') }}",
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
    ajax: "{{ route('admin.assets.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'category_name', name: 'category.name' },
{ data: 'name', name: 'name' },
{ data: 'photos', name: 'photos', sortable: false, searchable: false },
{ data: 'status_name', name: 'status.name' },
{ data: 'available', name: 'available' },
{ data: 'location_name', name: 'location.name' },
{ data: 'actual_holder_name', name: 'actual_holder.name' },
{ data: 'actual_holder.email', name: 'actual_holder.email' },
{ data: 'notes', name: 'notes' },
{ data: 'internal_notes', name: 'internal_notes' },
{ data: 'data_1', name: 'data_1' },
{ data: 'data_1_description', name: 'data_1_description' },
{ data: 'data_2', name: 'data_2' },
{ data: 'data_2_description', name: 'data_2_description' },
{ data: 'files', name: 'files', sortable: false, searchable: false },
{ data: 'link_a', name: 'link_a' },
{ data: 'link_a_description', name: 'link_a_description' },
{ data: 'link_b', name: 'link_b' },
{ data: 'link_b_description', name: 'link_b_description' },
{ data: 'last_use', name: 'last_use' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Asset').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection