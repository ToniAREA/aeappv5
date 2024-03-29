@extends('layouts.admin')
@section('content')
@can('social_account_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.social-accounts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.socialAccount.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'SocialAccount', 'route' => 'admin.social-accounts.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.socialAccount.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SocialAccount">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.socialAccount.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialAccount.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialAccount.fields.provider') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialAccount.fields.id_provider') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialAccount.fields.token') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialAccount.fields.refresh_token') }}
                        </th>
                        <th>
                            {{ trans('cruds.socialAccount.fields.expires_in') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socialAccounts as $key => $socialAccount)
                        <tr data-entry-id="{{ $socialAccount->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $socialAccount->id ?? '' }}
                            </td>
                            <td>
                                {{ $socialAccount->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $socialAccount->provider ?? '' }}
                            </td>
                            <td>
                                {{ $socialAccount->id_provider ?? '' }}
                            </td>
                            <td>
                                {{ $socialAccount->token ?? '' }}
                            </td>
                            <td>
                                {{ $socialAccount->refresh_token ?? '' }}
                            </td>
                            <td>
                                {{ $socialAccount->expires_in ?? '' }}
                            </td>
                            <td>
                                @can('social_account_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.social-accounts.show', $socialAccount->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('social_account_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.social-accounts.edit', $socialAccount->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('social_account_delete')
                                    <form action="{{ route('admin.social-accounts.destroy', $socialAccount->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('social_account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.social-accounts.massDestroy') }}",
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
  let table = $('.datatable-SocialAccount:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection