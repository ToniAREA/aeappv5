@extends('layouts.admin')
@section('content')
@can('plan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.plans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.plan.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Plan', 'route' => 'admin.plans.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.plan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Plan">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.plan_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.short_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.show_online') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.period') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.period_price') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.hourly_rate_discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.material_discount') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.contract') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.link_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.seo_title') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.seo_meta_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.plan.fields.seo_slug') }}
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
@can('plan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.plans.massDestroy') }}",
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
    ajax: "{{ route('admin.plans.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'plan_name', name: 'plan_name' },
{ data: 'short_description', name: 'short_description' },
{ data: 'description', name: 'description' },
{ data: 'photo', name: 'photo', sortable: false, searchable: false },
{ data: 'show_online', name: 'show_online' },
{ data: 'period', name: 'period' },
{ data: 'period_price', name: 'period_price' },
{ data: 'hourly_rate_discount', name: 'hourly_rate_discount' },
{ data: 'material_discount', name: 'material_discount' },
{ data: 'contract', name: 'contract', sortable: false, searchable: false },
{ data: 'link', name: 'link' },
{ data: 'link_description', name: 'link_description' },
{ data: 'seo_title', name: 'seo_title' },
{ data: 'seo_meta_description', name: 'seo_meta_description' },
{ data: 'seo_slug', name: 'seo_slug' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Plan').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection