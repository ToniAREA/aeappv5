@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.iotPlan.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('iot_plan_create')
                            <span>
                                <a class="btn btn-success" href="{{ route('frontend.iot-plans.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.iotPlan.title_singular') }}
                                </a>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                                    {{ trans('global.app_csvImport') }}
                                </button>
                                @include('csvImport.modal', [
                                    'model' => 'IotPlan',
                                    'route' => 'admin.iot-plans.parseCsvImport',
                                ])
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-IotPlan">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.iotPlan.fields.id') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.is_online') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.plan_name') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.short_description') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.description') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.photo') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.period') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.period_price') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.seo_title') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.seo_meta_description') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.seo_slug') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.contract') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.link') }}</th>
                                        <th>{{ trans('cruds.iotPlan.fields.link_description') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($iotPlans as $iotPlan)
                                        <tr data-entry-id="{{ $iotPlan->id }}">
                                            <td style="text-align: center">{{ $iotPlan->id ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $iotPlan->is_online ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled" {{ $iotPlan->is_online ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $iotPlan->plan_name ?? '' }}</td>
                                            <td>{{ $iotPlan->short_description ?? '' }}</td>
                                            <td>{{ $iotPlan->description ?? '' }}</td>
                                            <td>
                                                @if($iotPlan->photo)
                                                    <a href="{{ $iotPlan->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                                        <img src="{{ $iotPlan->photo->getUrl('thumb') }}">
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ App\Models\IotPlan::PERIOD_RADIO[$iotPlan->period] ?? '' }}</td>
                                            <td>{{ $iotPlan->period_price ?? '' }}</td>
                                            <td>{{ $iotPlan->seo_title ?? '' }}</td>
                                            <td>{{ $iotPlan->seo_meta_description ?? '' }}</td>
                                            <td>{{ $iotPlan->seo_slug ?? '' }}</td>
                                            <td>
                                                @if($iotPlan->contract)
                                                    <a href="{{ $iotPlan->contract->getUrl() }}" target="_blank">
                                                        {{ trans('global.view_file') }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $iotPlan->link ?? '' }}</td>
                                            <td>{{ $iotPlan->link_description ?? '' }}</td>
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
            let table = $('.datatable-IotPlan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            
        })
    </script>
@endsection