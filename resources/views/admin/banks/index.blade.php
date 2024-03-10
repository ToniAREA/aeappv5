@extends('layouts.admin')
@section('content')
@can('bank_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banks.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bank.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Bank', 'route' => 'admin.banks.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bank.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Bank">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.is_active') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.branch') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.account_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.account_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.swift_code') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.address') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.join_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.current_balance') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.internal_notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.link_a') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.link_a_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.link_b') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.link_b_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.bank.fields.files') }}
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
@can('bank_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.banks.massDestroy') }}",
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
    ajax: "{{ route('admin.banks.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'is_active', name: 'is_active' },
{ data: 'branch', name: 'branch' },
{ data: 'account_number', name: 'account_number' },
{ data: 'account_name', name: 'account_name' },
{ data: 'swift_code', name: 'swift_code' },
{ data: 'address', name: 'address' },
{ data: 'join_date', name: 'join_date' },
{ data: 'current_balance', name: 'current_balance' },
{ data: 'notes', name: 'notes' },
{ data: 'internal_notes', name: 'internal_notes' },
{ data: 'link_a', name: 'link_a' },
{ data: 'link_a_description', name: 'link_a_description' },
{ data: 'link_b', name: 'link_b' },
{ data: 'link_b_description', name: 'link_b_description' },
{ data: 'files', name: 'files', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Bank').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection