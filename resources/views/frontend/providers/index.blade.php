@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.provider.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('provider_create')
                            <span>
                                <a class="btn btn-success" href="{{ route('frontend.providers.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.provider.title_singular') }}
                                </a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'Provider',
                                    'route' => 'admin.providers.parseCsvImport',
                                ])
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-Provider">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.provider.fields.id') }}</th>
                                        <th>{{ trans('cruds.provider.fields.is_active') }}</th>
                                        <th>{{ trans('cruds.provider.fields.name') }}</th>
                                        <th>{{ trans('cruds.provider.fields.company') }}</th>
                                        <th>{{ trans('cruds.provider.fields.provider_logo') }}</th>
                                        <th>{{ trans('cruds.provider.fields.provider_url') }}</th>
                                        <th>{{ trans('cruds.provider.fields.brands') }}</th>
                                        <th>{{ trans('cruds.provider.fields.price_lists') }}</th>
                                        <th>{{ trans('cruds.provider.fields.notes') }}</th>
                                        <th>{{ trans('cruds.provider.fields.internal_notes') }}</th>
                                        <th>{{ trans('cruds.provider.fields.status') }}</th>
                                        <th>{{ trans('cruds.provider.fields.link') }}</th>
                                        <th>{{ trans('cruds.provider.fields.link_description') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($providers as $key => $provider)
                                        <tr data-entry-id="{{ $provider->id }}">
                                            <td style="text-align: center">{{ $provider->id ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $provider->is_active ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $provider->is_active ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $provider->name ?? '' }}</td>
                                            <td>{{ $provider->company->company_name ?? '' }}</td>
                                            <td>
                                                @if($provider->provider_logo)
                                                    <a href="{{ $provider->provider_logo->getUrl() }}" target="_blank" style="display: inline-block">
                                                        <img src="{{ $provider->provider_logo->getUrl('thumb') }}">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $provider->provider_url ?? '' }}</td>
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
                                            <td>{{ $provider->notes ?? '' }}</td>
                                            <td>{{ $provider->internal_notes ?? '' }}</td>
                                            <td>{{ $provider->status ?? '' }}</td>
                                            <td>{{ $provider->link ?? '' }}</td>
                                            <td>{{ $provider->link_description ?? '' }}</td>
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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
         
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[ 1, 'desc' ]],
                pageLength: 10,
            });
            let table = $('.datatable-Provider:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            
        })
    </script>
@endsection