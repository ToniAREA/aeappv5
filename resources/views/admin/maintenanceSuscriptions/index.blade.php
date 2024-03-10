@extends('layouts.admin')
@section('content')
@can('maintenance_suscription_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.maintenance-suscriptions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.maintenanceSuscription.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'MaintenanceSuscription', 'route' => 'admin.maintenance-suscriptions.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.maintenanceSuscription.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MaintenanceSuscription">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.is_active') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.client') }}
                    </th>
                    <th>
                        {{ trans('cruds.client.fields.lastname') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.boats') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.care_plan') }}
                    </th>
                    <th>
                        {{ trans('cruds.carePlan.fields.period') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.signed_contract') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.start_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.end_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.hourly_rate_discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.material_discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.link_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.internalnotes') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.completed_at') }}
                    </th>
                    <th>
                        {{ trans('cruds.maintenanceSuscription.fields.financial_document') }}
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
@can('maintenance_suscription_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.maintenance-suscriptions.massDestroy') }}",
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
    ajax: "{{ route('admin.maintenance-suscriptions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'is_active', name: 'is_active' },
{ data: 'client_name', name: 'client.name' },
{ data: 'client.lastname', name: 'client.lastname' },
{ data: 'boats', name: 'boats.name' },
{ data: 'care_plan_name', name: 'care_plan.name' },
{ data: 'care_plan.period', name: 'care_plan.period' },
{ data: 'signed_contract', name: 'signed_contract', sortable: false, searchable: false },
{ data: 'start_date', name: 'start_date' },
{ data: 'end_date', name: 'end_date' },
{ data: 'hourly_rate_discount', name: 'hourly_rate_discount' },
{ data: 'material_discount', name: 'material_discount' },
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
  let table = $('.datatable-MaintenanceSuscription').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection