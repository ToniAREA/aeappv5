<div class="m-3">
    @can('booking_slot_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.booking-slots.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.bookingSlot.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.bookingSlot.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-employeeBookingSlots">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.bookingSlot.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.bookingSlot.fields.is_online') }}
                            </th>
                            <th>
                                {{ trans('cruds.bookingSlot.fields.employee') }}
                            </th>
                            <th>
                                {{ trans('cruds.employee.fields.category') }}
                            </th>
                            <th>
                                {{ trans('cruds.bookingSlot.fields.star_time') }}
                            </th>
                            <th>
                                {{ trans('cruds.bookingSlot.fields.end_time') }}
                            </th>
                            <th>
                                {{ trans('cruds.bookingSlot.fields.rate_multiplier') }}
                            </th>
                            <th>
                                {{ trans('cruds.bookingSlot.fields.booked') }}
                            </th>
                            <th>
                                {{ trans('cruds.bookingSlot.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookingSlots as $key => $bookingSlot)
                            <tr data-entry-id="{{ $bookingSlot->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $bookingSlot->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $bookingSlot->is_online ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $bookingSlot->is_online ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $bookingSlot->employee->id_employee ?? '' }}
                                </td>
                                <td>
                                    {{ $bookingSlot->employee->category ?? '' }}
                                </td>
                                <td>
                                    {{ $bookingSlot->star_time ?? '' }}
                                </td>
                                <td>
                                    {{ $bookingSlot->end_time ?? '' }}
                                </td>
                                <td>
                                    {{ $bookingSlot->rate_multiplier ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $bookingSlot->booked ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $bookingSlot->booked ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $bookingSlot->status->name ?? '' }}
                                </td>
                                <td>
                                    @can('booking_slot_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.booking-slots.show', $bookingSlot->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('booking_slot_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.booking-slots.edit', $bookingSlot->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('booking_slot_delete')
                                        <form action="{{ route('admin.booking-slots.destroy', $bookingSlot->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('booking_slot_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.booking-slots.massDestroy') }}",
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
  let table = $('.datatable-employeeBookingSlots:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection