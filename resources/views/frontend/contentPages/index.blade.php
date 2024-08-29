@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('content_page_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.content-pages.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.contentPage.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'ContentPage', 'route' => 'admin.content-pages.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.contentPage.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-ContentPage">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.is_online') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.slug') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.tag') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.featured_image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.file') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.seo_title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.seo_meta_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.seo_slug') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.link_a') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.link_a_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.show_online_link_a') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.link_b') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.link_b_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.show_online_link_b') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.view_count') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.authorized_roles') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.contentPage.fields.authorized_users') }}
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
                                            @foreach($content_categories as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($content_tags as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
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
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($roles as $key => $item)
                                                <option value="{{ $item->title }}">{{ $item->title }}</option>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contentPages as $key => $contentPage)
                                    <tr data-entry-id="{{ $contentPage->id }}">
                                        <td>
                                            {{ $contentPage->id ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $contentPage->is_online ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $contentPage->is_online ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $contentPage->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contentPage->slug ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($contentPage->categories as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($contentPage->tags as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($contentPage->featured_image as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $media->getUrl('thumb') }}">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($contentPage->file as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $contentPage->seo_title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contentPage->seo_meta_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contentPage->seo_slug ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contentPage->link_a ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contentPage->link_a_description ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $contentPage->show_online_link_a ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $contentPage->show_online_link_a ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $contentPage->link_b ?? '' }}
                                        </td>
                                        <td>
                                            {{ $contentPage->link_b_description ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $contentPage->show_online_link_b ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $contentPage->show_online_link_b ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $contentPage->view_count ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($contentPage->authorized_roles as $key => $item)
                                                <span>{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($contentPage->authorized_users as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('content_page_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.content-pages.show', $contentPage->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('content_page_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.content-pages.edit', $contentPage->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('content_page_delete')
                                                <form action="{{ route('frontend.content-pages.destroy', $contentPage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('content_page_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.content-pages.massDestroy') }}",
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
  let table = $('.datatable-ContentPage:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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