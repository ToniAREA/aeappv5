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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Plan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.plan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.plan.fields.is_online') }}
                        </th>
                        <th>
                            {{ trans('cruds.plan.fields.plan_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.plan.fields.short_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.plan.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.plan.fields.period') }}
                        </th>
                        <th>
                            {{ trans('cruds.plan.fields.period_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.plan.fields.hourly_rate') }}
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
                <tbody>
                    @foreach($plans as $key => $plan)
                        <tr data-entry-id="{{ $plan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $plan->id ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $plan->is_online ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $plan->is_online ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $plan->plan_name ?? '' }}
                            </td>
                            <td>
                                {{ $plan->short_description ?? '' }}
                            </td>
                            <td>
                                @if($plan->photo)
                                    <a href="{{ $plan->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $plan->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ App\Models\Plan::PERIOD_RADIO[$plan->period] ?? '' }}
                            </td>
                            <td>
                                {{ $plan->period_price ?? '' }}
                            </td>
                            <td>
                                {{ $plan->hourly_rate ?? '' }}
                            </td>
                            <td>
                                {{ $plan->hourly_rate_discount ?? '' }}
                            </td>
                            <td>
                                {{ $plan->material_discount ?? '' }}
                            </td>
                            <td>
                                @if($plan->contract)
                                    <a href="{{ $plan->contract->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $plan->link ?? '' }}
                            </td>
                            <td>
                                {{ $plan->link_description ?? '' }}
                            </td>
                            <td>
                                {{ $plan->seo_title ?? '' }}
                            </td>
                            <td>
                                {{ $plan->seo_meta_description ?? '' }}
                            </td>
                            <td>
                                {{ $plan->seo_slug ?? '' }}
                            </td>
                            <td>
                                @can('plan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.plans.show', $plan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('plan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.plans.edit', $plan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('plan_delete')
                                    <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('plan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.plans.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Plan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection