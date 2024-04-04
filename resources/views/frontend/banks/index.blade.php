@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('bank_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.banks.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.bank.title_singular') }}
                        </a>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                            {{ trans('global.app_csvImport') }}
                        </button>
                        @include('csvImport.modal', ['model' => 'Bank', 'route' => 'admin.banks.parseCsvImport'])
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.bank.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Bank">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.bank.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.is_active') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.branch') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.account_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.account_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.swift_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.address') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.join_date') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.current_balance') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.internal_notes') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.link_a') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.link_a_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.link_b') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.link_b_description') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.files') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.bank.fields.bank_logo') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($banks as $key => $bank)
                                    <tr data-entry-id="{{ $bank->id }}">
                                        <td>
                                            {{ $bank->id ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $bank->is_active ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $bank->is_active ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $bank->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->branch ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->account_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->account_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->swift_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->address ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->join_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->current_balance ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->internal_notes ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->link_a ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->link_a_description ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->link_b ?? '' }}
                                        </td>
                                        <td>
                                            {{ $bank->link_b_description ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($bank->files as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($bank->bank_logo)
                                                <a href="{{ $bank->bank_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $bank->bank_logo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('bank_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.banks.show', $bank->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('bank_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.banks.edit', $bank->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('bank_delete')
                                                <form action="{{ route('frontend.banks.destroy', $bank->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('bank_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.banks.massDestroy') }}",
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
  let table = $('.datatable-Bank:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection