@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('asset_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.assets.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.asset.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Asset', 'route' => 'admin.assets.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.asset.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.asset.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.photos') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.available') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.location') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.actual_holder') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.internal_notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.data_1') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.data_1_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.data_2') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.data_2_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.files') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.link_a') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.link_a_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.link_b') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.link_b_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.asset.fields.last_use') }}
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
                                            @foreach($asset_categories as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($asset_statuses as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($asset_locations as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $key => $asset)
                                    <tr data-entry-id="{{ $asset->id }}">
                                        <td>
                                            {{ $asset->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->name ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($asset->photos as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $asset->status->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $asset->available ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $asset->available ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $asset->location->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->actual_holder->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->actual_holder->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->internal_notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->data_1 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->data_1_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->data_2 ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->data_2_description ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($asset->files as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $asset->link_a ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->link_a_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->link_b ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->link_b_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $asset->last_use ?? '' }}
                                        </td>
                                        <td>
                                            @can('asset_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.assets.show', $asset->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('asset_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.assets.edit', $asset->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('asset_delete')
                                                <form action="{{ route('frontend.assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('asset_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.assets.massDestroy') }}",
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
  let table = $('.datatable-Asset:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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