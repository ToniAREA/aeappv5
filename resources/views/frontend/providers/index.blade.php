@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('provider_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.providers.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.provider.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Provider', 'route' => 'admin.providers.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.provider.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Provider">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.provider.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.is_active') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.company') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.provider_logo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.provider_url') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.brands') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.price_lists') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.internal_notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.status') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.link') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.provider.fields.link_description') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($providers as $key => $provider)
                                    <tr data-entry-id="{{ $provider->id }}">
                                        <td>
                                            {{ $provider->id ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $provider->is_active ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $provider->is_active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $provider->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $provider->company->company_name ?? '' }}
                                        </td>
                                        <td>
                                            @if($provider->provider_logo)
                                                <a href="{{ $provider->provider_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $provider->provider_logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $provider->provider_url ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($provider->brands as $key => $item)
                                                <span>{{ $item->brand }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($provider->price_lists as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $provider->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $provider->internal_notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $provider->status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $provider->link ?? '' }}
                                        </td>
                                        <td>
                                            {{ $provider->link_description ?? '' }}
                                        </td>
                                        <td>
                                            @can('provider_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.providers.show', $provider->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('provider_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.providers.edit', $provider->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('provider_delete')
                                                <form action="{{ route('frontend.providers.destroy', $provider->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('provider_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.providers.massDestroy') }}",
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
  let table = $('.datatable-Provider:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection