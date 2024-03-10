@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('video_tutorial_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.video-tutorials.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.videoTutorial.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'VideoTutorial', 'route' => 'admin.video-tutorials.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.videoTutorial.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-VideoTutorial">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.show_online') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.video_url') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.subjects') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.seo_title') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.seo_meta_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.seo_slug') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.authorized_roles') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.videoTutorial.fields.authorized_users') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($videoTutorials as $key => $videoTutorial)
                                    <tr data-entry-id="{{ $videoTutorial->id }}">
                                        <td>
                                            {{ $videoTutorial->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $videoTutorial->title ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $videoTutorial->show_online ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $videoTutorial->show_online ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $videoTutorial->description ?? '' }}
                                        </td>
                                        <td>
                                            @if($videoTutorial->image)
                                                <a href="{{ $videoTutorial->image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $videoTutorial->image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $videoTutorial->video_url ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($videoTutorial->subjects as $key => $item)
                                                <span>{{ $item->subject }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $videoTutorial->seo_title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $videoTutorial->seo_meta_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $videoTutorial->seo_slug ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($videoTutorial->authorized_roles as $key => $item)
                                                <span>{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($videoTutorial->authorized_users as $key => $item)
                                                <span>{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('video_tutorial_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.video-tutorials.show', $videoTutorial->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('video_tutorial_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.video-tutorials.edit', $videoTutorial->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('video_tutorial_delete')
                                                <form action="{{ route('frontend.video-tutorials.destroy', $videoTutorial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('video_tutorial_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.video-tutorials.massDestroy') }}",
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
  let table = $('.datatable-VideoTutorial:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection