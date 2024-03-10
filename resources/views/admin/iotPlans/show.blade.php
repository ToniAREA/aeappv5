@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.iotPlan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.iot-plans.index') }}">
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
                <a class="btn btn-default" href="{{ route('admin.iot-plans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#plan_iot_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.iotSuscription.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="plan_iot_suscriptions">
            @includeIf('admin.iotPlans.relationships.planIotSuscriptions', ['iotSuscriptions' => $iotPlan->planIotSuscriptions])
        </div>
    </div>
</div>

@endsection