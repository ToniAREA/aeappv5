@extends('layouts.admin')
@section('content')
@can('iot_plan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.iot-plans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.iotPlan.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'IotPlan', 'route' => 'admin.iot-plans.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.iotPlan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-IotPlan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.plan_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.short_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.show_online') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.period') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.period_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.seo_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.seo_meta_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.seo_slug') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.contract') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.iotPlan.fields.link_description') }}
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
@can('iot_plan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.iot-plans.massDestroy') }}",
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
    ajax: "{{ route('admin.iot-plans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'plan_name', name: 'plan_name' },
{ data: 'short_description', name: 'short_description' },
{ data: 'description', name: 'description' },
{ data: 'show_online', name: 'show_online' },
{ data: 'period', name: 'period' },
{ data: 'period_price', name: 'period_price' },
{ data: 'seo_title', name: 'seo_title' },
{ data: 'seo_meta_description', name: 'seo_meta_description' },
{ data: 'seo_slug', name: 'seo_slug' },
{ data: 'contract', name: 'contract', sortable: false, searchable: false },
{ data: 'link', name: 'link' },
{ data: 'link_description', name: 'link_description' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-IotPlan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection