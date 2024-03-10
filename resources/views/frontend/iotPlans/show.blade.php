@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.iotPlan.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.iot-plans.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.plan_name') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->plan_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.short_description') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->short_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.show_online') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $iotPlan->show_online ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.period') }}
                                    </th>
                                    <td>
                                        {{ App\Models\IotPlan::PERIOD_RADIO[$iotPlan->period] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.period_price') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->period_price }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.seo_title') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->seo_title }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.seo_meta_description') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->seo_meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.seo_slug') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->seo_slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.contract') }}
                                    </th>
                                    <td>
                                        @if($iotPlan->contract)
                                            <a href="{{ $iotPlan->contract->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotPlan.fields.link_description') }}
                                    </th>
                                    <td>
                                        {{ $iotPlan->link_description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.iot-plans.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection