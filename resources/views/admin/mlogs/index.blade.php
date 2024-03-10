@extends('layouts.admin')
@section('content')
@can('mlog_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mlogs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mlog.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Mlog', 'route' => 'admin.mlogs.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.mlog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Mlog">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.boat') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.boat_namecomplete') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.wlist') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.employee') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.item') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.product') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.photos') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.units') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.price_unit') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.invoiced_line') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.internal_notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.mlog.fields.financial_document') }}
                    </th>
                    <th>
                        {{ trans('cruds.finalcialDocument.fields.doc_type') }}
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
                            @foreach($boats as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($wlists as $key => $item)
                                <option value="{{ $item->description }}">{{ $item->description }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($products as $key => $item)
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($finalcial_documents as $key => $item)
                                <option value="{{ $item->reference_number }}">{{ $item->reference_number }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
@can('mlog_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mlogs.massDestroy') }}",
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
    ajax: "{{ route('admin.mlogs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'boat_name', name: 'boat.name' },
{ data: 'boat_namecomplete', name: 'boat_namecomplete' },
{ data: 'wlist_description', name: 'wlist.description' },
{ data: 'date', name: 'date' },
{ data: 'employee_name', name: 'employee.name' },
{ data: 'employee.email', name: 'employee.email' },
{ data: 'item', name: 'item' },
{ data: 'product_name', name: 'product.name' },
{ data: 'description', name: 'description' },
{ data: 'photos', name: 'photos', sortable: false, searchable: false },
{ data: 'units', name: 'units' },
{ data: 'price_unit', name: 'price_unit' },
{ data: 'invoiced_line', name: 'invoiced_line' },
{ data: 'internal_notes', name: 'internal_notes' },
{ data: 'financial_document_reference_number', name: 'financial_document.reference_number' },
{ data: 'financial_document.doc_type', name: 'financial_document.doc_type' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Mlog').DataTable(dtOverrideGlobals);
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