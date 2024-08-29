@extends('layouts.admin')
@section('content')
@can('booking_list_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.booking-lists.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bookingList.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'BookingList', 'route' => 'admin.booking-lists.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bookingList.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BookingList">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.client.fields.lastname') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.boat') }}
                        </th>
                        <th>
                            {{ trans('cruds.boat.fields.boat_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.employee') }}
                        </th>
                        <th>
                            {{ trans('cruds.employee.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.booking_slot') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingSlot.fields.end_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.hours') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.start_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.end_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.hourly_rate') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.total_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.confirmed') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.is_invoiced') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.notes') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.internal_notes') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.completed_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingList.fields.financial_document') }}
                        </th>
                        <th>
                            {{ trans('cruds.finalcialDocument.fields.doc_type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($clients as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($boats as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($employees as $key => $item)
                                    <option value="{{ $item->id_employee }}">{{ $item->id_employee }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($booking_slots as $key => $item)
                                    <option value="{{ $item->star_time }}">{{ $item->star_time }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($finalcial_documents as $key => $item)
                                    <option value="{{ $item->reference_number }}">{{ $item->reference_number }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookingLists as $key => $bookingList)
                        <tr data-entry-id="{{ $bookingList->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $bookingList->id ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->client->name ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->client->lastname ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->boat->name ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->boat->boat_type ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->employee->id_employee ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->employee->category ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->booking_slot->star_time ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->booking_slot->end_time ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->date ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->hours ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->start_time ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->end_time ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->hourly_rate ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->total_amount ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $bookingList->confirmed ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $bookingList->confirmed ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $bookingList->status ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $bookingList->is_invoiced ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $bookingList->is_invoiced ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $bookingList->notes ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->internal_notes ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->completed_at ?? '' }}
                            </td>
                            <td>
                                {{ $bookingList->financial_document->reference_number ?? '' }}
                            </td>
                            <td>
                                @if($bookingList->financial_document)
                                    {{ $bookingList->financial_document::DOC_TYPE_RADIO[$bookingList->financial_document->doc_type] ?? '' }}
                                @endif
                            </td>
                            <td>
                                @can('booking_list_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.booking-lists.show', $bookingList->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('booking_list_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.booking-lists.edit', $bookingList->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('booking_list_delete')
                                    <form action="{{ route('admin.booking-lists.destroy', $bookingList->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('booking_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.booking-lists.massDestroy') }}",
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
  let table = $('.datatable-BookingList:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection