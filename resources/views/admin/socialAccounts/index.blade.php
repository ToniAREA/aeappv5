@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.socialAccount.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SocialAccount">
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.social-accounts.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'provider', name: 'provider' },
{ data: 'id_provider', name: 'id_provider' },
{ data: 'token', name: 'token' },
{ data: 'refresh_token', name: 'refresh_token' },
{ data: 'expires_in', name: 'expires_in' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SocialAccount').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection