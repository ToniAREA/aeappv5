@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('iot_plan_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.iot-plans.create') }}">
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
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-IotPlan">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($iotPlans as $key => $iotPlan)
                                    <tr data-entry-id="{{ $iotPlan->id }}">
                                        <td>
                                            {{ $iotPlan->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $iotPlan->plan_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $iotPlan->short_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $iotPlan->description ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $iotPlan->show_online ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $iotPlan->show_online ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ App\Models\IotPlan::PERIOD_RADIO[$iotPlan->period] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $iotPlan->period_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $iotPlan->seo_title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $iotPlan->seo_meta_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $iotPlan->seo_slug ?? '' }}
                                        </td>
                                        <td>
                                            @if($iotPlan->contract)
                                                <a href="{{ $iotPlan->contract->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $iotPlan->link ?? '' }}
                                        </td>
                                        <td>
                                            {{ $iotPlan->link_description ?? '' }}
                                        </td>
                                        <td>
                                            @can('iot_plan_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.iot-plans.show', $iotPlan->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('iot_plan_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.iot-plans.edit', $iotPlan->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('iot_plan_delete')
                                                <form action="{{ route('frontend.iot-plans.destroy', $iotPlan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('iot_plan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.iot-plans.massDestroy') }}",
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
  let table = $('.datatable-IotPlan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection