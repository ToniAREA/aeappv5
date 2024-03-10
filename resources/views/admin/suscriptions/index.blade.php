@extends('layouts.admin')
@section('content')
@can('suscription_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.suscriptions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.suscription.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Suscription', 'route' => 'admin.suscriptions.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.suscription.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Suscription">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.is_active') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.lastname') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.boats') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.plan') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.signed_contract') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.end_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.link_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.internalnotes') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.completed_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.suscription.fields.financial_document') }}
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
@can('suscription_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.suscriptions.massDestroy') }}",
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
    ajax: "{{ route('admin.suscriptions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'is_active', name: 'is_active' },
{ data: 'client_name', name: 'client.name' },
{ data: 'client.lastname', name: 'client.lastname' },
{ data: 'boats', name: 'boats.name' },
{ data: 'plan_plan_name', name: 'plan.plan_name' },
{ data: 'signed_contract', name: 'signed_contract', sortable: false, searchable: false },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'link', name: 'link' },
{ data: 'link_description', name: 'link_description' },
{ data: 'notes', name: 'notes' },
{ data: 'internalnotes', name: 'internalnotes' },
{ data: 'completed_at', name: 'completed_at' },
{ data: 'financial_document_reference_number', name: 'financial_document.reference_number' },
{ data: 'financial_document.doc_type', name: 'financial_document.doc_type' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Suscription').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection