<div class="m-3">
    @can('care_plan_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.care-plans.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.carePlan.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.carePlan.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-checkpointsCarePlans">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.carePlan.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.carePlan.fields.is_online') }}
                            </th>
                            <th>
                                {{ trans('cruds.carePlan.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.carePlan.fields.short_description') }}
                            </th>
                            <th>
                                {{ trans('cruds.carePlan.fields.photo') }}
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

                                </td>
                                <td>
                                    {{ $carePlan->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $carePlan->is_online ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $carePlan->is_online ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $carePlan->name ?? '' }}
                                </td>
                                <td>
                                    {{ $carePlan->short_description ?? '' }}
                                </td>
                                <td>
                                    @if($carePlan->photo)
                                        <a href="{{ $carePlan->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $carePlan->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @foreach($carePlan->checkpoints as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
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
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.care-plans.show', $carePlan->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('care_plan_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.care-plans.edit', $carePlan->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('care_plan_delete')
                                        <form action="{{ route('admin.care-plans.destroy', $carePlan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('care_plan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.care-plans.massDestroy') }}",
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
  let table = $('.datatable-checkpointsCarePlans:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection