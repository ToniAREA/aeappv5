<div class="m-3">
    @can('assets_rental_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.assets-rentals.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.assetsRental.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.assetsRental.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-userAssetsRentals">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.is_active') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.asset') }}
                            </th>
                            <th>
                                {{ trans('cruds.asset.fields.data_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.lastname') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.boat') }}
                            </th>
                            <th>
                                {{ trans('cruds.boat.fields.boat_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.start_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.end_date') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.rental_details') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.invoiced') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.link') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.link_description') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.completed_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.rental_unit') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.rental_quantity') }}
                            </th>
                            <th>
                                {{ trans('cruds.assetsRental.fields.financial_document') }}
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
                        @foreach($assetsRentals as $key => $assetsRental)
                            <tr data-entry-id="{{ $assetsRental->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $assetsRental->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $assetsRental->is_active ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $assetsRental->is_active ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $assetsRental->asset->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->asset->data_1 ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->client->lastname ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->boat->name ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->boat->boat_type ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->start_date ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->end_date ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->rental_details ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $assetsRental->invoiced ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $assetsRental->invoiced ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $assetsRental->link ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->link_description ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->completed_at ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\AssetsRental::RENTAL_UNIT_SELECT[$assetsRental->rental_unit] ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->rental_quantity ?? '' }}
                                </td>
                                <td>
                                    {{ $assetsRental->financial_document->reference_number ?? '' }}
                                </td>
                                <td>
                                    @if($assetsRental->financial_document)
                                        {{ $assetsRental->financial_document::DOC_TYPE_RADIO[$assetsRental->financial_document->doc_type] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @can('assets_rental_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.assets-rentals.show', $assetsRental->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('assets_rental_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.assets-rentals.edit', $assetsRental->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('assets_rental_delete')
                                        <form action="{{ route('admin.assets-rentals.destroy', $assetsRental->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('assets_rental_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assets-rentals.massDestroy') }}",
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
  let table = $('.datatable-userAssetsRentals:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection