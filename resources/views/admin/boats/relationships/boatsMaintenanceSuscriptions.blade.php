<div class="m-3">
    @can('maintenance_suscription_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.maintenance-suscriptions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.maintenanceSuscription.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.maintenanceSuscription.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-boatsMaintenanceSuscriptions">
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
                                {{ trans('cruds.maintenanceSuscription.fields.hourly_rate') }}
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
                    <tbody>
                        @foreach($maintenanceSuscriptions as $key => $maintenanceSuscription)
                            <tr data-entry-id="{{ $maintenanceSuscription->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $maintenanceSuscription->id ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->user->email ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $maintenanceSuscription->is_active ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $maintenanceSuscription->is_active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->client->lastname ?? '' }}
                                </td>
                                <td>
                                    @foreach($maintenanceSuscription->boats as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->care_plan->name ?? '' }}
                                </td>
                                <td>
                                    @if($maintenanceSuscription->care_plan)
                                        {{ $maintenanceSuscription->care_plan::PERIOD_RADIO[$maintenanceSuscription->care_plan->period] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @if($maintenanceSuscription->signed_contract)
                                        <a href="{{ $maintenanceSuscription->signed_contract->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->end_date ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->hourly_rate ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->hourly_rate_discount ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->material_discount ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->link ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->link_description ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->notes ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->internalnotes ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->completed_at ?? '' }}
                                </td>
                                <td>
                                    {{ $maintenanceSuscription->financial_document->reference_number ?? '' }}
                                </td>
                                <td>
                                    @if($maintenanceSuscription->financial_document)
                                        {{ $maintenanceSuscription->financial_document::DOC_TYPE_RADIO[$maintenanceSuscription->financial_document->doc_type] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @can('maintenance_suscription_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.maintenance-suscriptions.show', $maintenanceSuscription->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('maintenance_suscription_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.maintenance-suscriptions.edit', $maintenanceSuscription->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('maintenance_suscription_delete')
                                        <form action="{{ route('admin.maintenance-suscriptions.destroy', $maintenanceSuscription->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('maintenance_suscription_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.maintenance-suscriptions.massDestroy') }}",
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
  let table = $('.datatable-boatsMaintenanceSuscriptions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection