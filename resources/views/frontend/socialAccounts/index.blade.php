@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.socialAccount.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-SocialAccount">
                            <thead>
                                <tr>
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