@extends('layouts.admin')
@section('content')
@can('contact_company_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.contact-companies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.contactCompany.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ContactCompany', 'route' => 'admin.contact-companies.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contactCompany.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ContactCompany">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.defaulter') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_vat') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_address') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_mobile') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_phone') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_email') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_website') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.company_social_link') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.contacts') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.link') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.link_description') }}
                    </th>
                    <th>
                        {{ trans('cruds.contactCompany.fields.last_use') }}
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($contact_contacts as $key => $item)
                                <option value="{{ $item->contact_first_name }}">{{ $item->contact_first_name }}</option>
                            @endforeach
                        </select>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('contact_company_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.contact-companies.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.contact-companies.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'defaulter', name: 'defaulter' },
{ data: 'company_name', name: 'company_name' },
{ data: 'company_vat', name: 'company_vat' },
{ data: 'company_address', name: 'company_address' },
{ data: 'company_mobile', name: 'company_mobile' },
{ data: 'company_phone', name: 'company_phone' },
{ data: 'company_email', name: 'company_email' },
{ data: 'company_website', name: 'company_website' },
{ data: 'company_social_link', name: 'company_social_link' },
{ data: 'contacts', name: 'contacts.contact_first_name' },
{ data: 'link', name: 'link' },
{ data: 'link_description', name: 'link_description' },
{ data: 'last_use', name: 'last_use' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ContactCompany').DataTable(dtOverrideGlobals);
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
});

</script>
@endsection