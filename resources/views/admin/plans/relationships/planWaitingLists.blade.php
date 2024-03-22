<div class="m-3">
    @can('waiting_list_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.waiting-lists.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.waitingList.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.waitingList.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-planWaitingLists">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.waitingList.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.waitingList.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.waitingList.fields.client') }}
                            </th>
                            <th>
                                {{ trans('cruds.client.fields.lastname') }}
                            </th>
                            <th>
                                {{ trans('cruds.waitingList.fields.boats') }}
                            </th>
                            <th>
                                {{ trans('cruds.waitingList.fields.plan') }}
                            </th>
                            <th>
                                {{ trans('cruds.plan.fields.short_description') }}
                            </th>
                            <th>
                                {{ trans('cruds.waitingList.fields.waiting_for') }}
                            </th>
                            <th>
                                {{ trans('cruds.waitingList.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.waitingList.fields.notes') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($waitingLists as $key => $waitingList)
                            <tr data-entry-id="{{ $waitingList->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $waitingList->id ?? '' }}
                                </td>
                                <td>
                                    {{ $waitingList->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $waitingList->user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $waitingList->client->name ?? '' }}
                                </td>
                                <td>
                                    {{ $waitingList->client->lastname ?? '' }}
                                </td>
                                <td>
                                    @foreach($waitingList->boats as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $waitingList->plan->plan_name ?? '' }}
                                </td>
                                <td>
                                    {{ $waitingList->plan->short_description ?? '' }}
                                </td>
                                <td>
                                    {{ $waitingList->waiting_for ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\WaitingList::STATUS_SELECT[$waitingList->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $waitingList->notes ?? '' }}
                                </td>
                                <td>
                                    @can('waiting_list_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.waiting-lists.show', $waitingList->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('waiting_list_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.waiting-lists.edit', $waitingList->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('waiting_list_delete')
                                        <form action="{{ route('admin.waiting-lists.destroy', $waitingList->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('waiting_list_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.waiting-lists.massDestroy') }}",
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
  let table = $('.datatable-planWaitingLists:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection