@extends('layouts.admin')
@section('content')
@can('insurance_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.insurances.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.insurance.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Insurance', 'route' => 'admin.insurances.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.insurance.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Insurance">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.provider_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.contactCompany.fields.company_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.policy_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.period') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.period_cost') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.is_active') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.coverage_type') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.files') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.notes') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.internalnotes') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.link_a') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.link_a_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.link_b') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.link_b_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.insurance.fields.contacts') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($insurances as $key => $insurance)
                        <tr data-entry-id="{{ $insurance->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $insurance->id ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->provider_name ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->company->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->company->company_email ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->policy_number ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Insurance::PERIOD_RADIO[$insurance->period] ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->period_cost ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $insurance->is_active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $insurance->is_active ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $insurance->coverage_type ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->end_date ?? '' }}
                            </td>
                            <td>
                                @foreach($insurance->files as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $insurance->notes ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->internalnotes ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->link_a ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->link_a_description ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->link_b ?? '' }}
                            </td>
                            <td>
                                {{ $insurance->link_b_description ?? '' }}
                            </td>
                            <td>
                                @foreach($insurance->contacts as $key => $item)
                                    <span class="badge badge-info">{{ $item->contact_first_name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('insurance_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.insurances.show', $insurance->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('insurance_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.insurances.edit', $insurance->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('insurance_delete')
                                    <form action="{{ route('admin.insurances.destroy', $insurance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('insurance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.insurances.massDestroy') }}",
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
  let table = $('.datatable-Insurance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection