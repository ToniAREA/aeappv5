<div class="m-3">
    @can('faq_question_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.faq-questions.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.faqQuestion.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.faqQuestion.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-authorizedUsersFaqQuestions">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.faqQuestion.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.faqQuestion.fields.is_online') }}
                            </th>
                            <th>
                                {{ trans('cruds.faqQuestion.fields.category') }}
                            </th>
                            <th>
                                {{ trans('cruds.faqQuestion.fields.photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.faqQuestion.fields.files') }}
                            </th>
                            <th>
                                {{ trans('cruds.faqQuestion.fields.view_count') }}
                            </th>
                            <th>
                                {{ trans('cruds.faqQuestion.fields.authorized_roles') }}
                            </th>
                            <th>
                                {{ trans('cruds.faqQuestion.fields.authorized_users') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqQuestions as $key => $faqQuestion)
                            <tr data-entry-id="{{ $faqQuestion->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $faqQuestion->id ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $faqQuestion->is_online ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $faqQuestion->is_online ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $faqQuestion->category->category ?? '' }}
                                </td>
                                <td>
                                    @if($faqQuestion->photo)
                                        <a href="{{ $faqQuestion->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $faqQuestion->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @foreach($faqQuestion->files as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $faqQuestion->view_count ?? '' }}
                                </td>
                                <td>
                                    @foreach($faqQuestion->authorized_roles as $key => $item)
                                        <span class="badge badge-info">{{ $item->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($faqQuestion->authorized_users as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('faq_question_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.faq-questions.show', $faqQuestion->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('faq_question_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.faq-questions.edit', $faqQuestion->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('faq_question_delete')
                                        <form action="{{ route('admin.faq-questions.destroy', $faqQuestion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('faq_question_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.faq-questions.massDestroy') }}",
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
  let table = $('.datatable-authorizedUsersFaqQuestions:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection