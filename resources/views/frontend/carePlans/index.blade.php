@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('care_plan_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.care-plans.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.carePlan.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'CarePlan', 'route' => 'admin.care-plans.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.carePlan.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CarePlan">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.short_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.checkpoints') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.period') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.period_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.seo_title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.seo_meta_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.carePlan.fields.seo_slug') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carePlans as $key => $carePlan)
                                    <tr data-entry-id="{{ $carePlan->id }}">
                                        <td>
                                            {{ $carePlan->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carePlan->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carePlan->short_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carePlan->description ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($carePlan->checkpoints as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ App\Models\CarePlan::PERIOD_RADIO[$carePlan->period] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carePlan->period_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carePlan->seo_title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carePlan->seo_meta_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $carePlan->seo_slug ?? '' }}
                                        </td>
                                        <td>
                                            @can('care_plan_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.care-plans.show', $carePlan->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('care_plan_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.care-plans.edit', $carePlan->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('care_plan_delete')
                                                <form action="{{ route('frontend.care-plans.destroy', $carePlan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('care_plan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.care-plans.massDestroy') }}",
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
  let table = $('.datatable-CarePlan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection