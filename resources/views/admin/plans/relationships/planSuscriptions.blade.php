<div class="m-3">
    @can('suscription_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.suscriptions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.suscription.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.suscription.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-planSuscriptions">
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
                                {{ trans('cruds.suscription.fields.proforma') }}
                            </th>
                            <th>
                                {{ trans('cruds.proforma.fields.description') }}
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
                                {{ trans('cruds.suscription.fields.hourly_rate_discount') }}
                            </th>
                            <th>
                                {{ trans('cruds.suscription.fields.material_discount') }}
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
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suscriptions as $key => $suscription)
                            <tr data-entry-id="{{ $suscription->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $suscription->id ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->user->email ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $suscription->is_active ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $suscription->is_active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $suscription->proforma->proforma_number ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->proforma->description ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->client->lastname ?? '' }}
                                </td>
                                <td>
                                    @foreach($suscription->boats as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $suscription->plan->plan_name ?? '' }}
                                </td>
                                <td>
                                    @if($suscription->signed_contract)
                                        <a href="{{ $suscription->signed_contract->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{ $suscription->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->end_date ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->hourly_rate_discount ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->material_discount ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->link ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->link_description ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->notes ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->internalnotes ?? '' }}
                                </td>
                                <td>
                                    {{ $suscription->completed_at ?? '' }}
                                </td>
                                <td>
                                    @can('suscription_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.suscriptions.show', $suscription->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('suscription_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.suscriptions.edit', $suscription->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('suscription_delete')
                                        <form action="{{ route('admin.suscriptions.destroy', $suscription->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('suscription_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.suscriptions.massDestroy') }}",
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
  let table = $('.datatable-planSuscriptions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection