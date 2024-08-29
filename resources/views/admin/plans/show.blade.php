@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.plan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.plans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.id') }}
                        </th>
                        <td>
                            {{ $plan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.is_online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $plan->is_online ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.plan_name') }}
                        </th>
                        <td>
                            {{ $plan->plan_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.short_description') }}
                        </th>
                        <td>
                            {{ $plan->short_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.description') }}
                        </th>
                        <td>
                            {!! $plan->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.photo') }}
                        </th>
                        <td>
                            @if($plan->photo)
                                <a href="{{ $plan->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $plan->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.period') }}
                        </th>
                        <td>
                            {{ App\Models\Plan::PERIOD_RADIO[$plan->period] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.period_price') }}
                        </th>
                        <td>
                            {{ $plan->period_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.hourly_rate') }}
                        </th>
                        <td>
                            {{ $plan->hourly_rate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.hourly_rate_discount') }}
                        </th>
                        <td>
                            {{ $plan->hourly_rate_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.material_discount') }}
                        </th>
                        <td>
                            {{ $plan->material_discount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.contract') }}
                        </th>
                        <td>
                            @if($plan->contract)
                                <a href="{{ $plan->contract->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.link') }}
                        </th>
                        <td>
                            {{ $plan->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.link_description') }}
                        </th>
                        <td>
                            {{ $plan->link_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.seo_title') }}
                        </th>
                        <td>
                            {{ $plan->seo_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.seo_meta_description') }}
                        </th>
                        <td>
                            {{ $plan->seo_meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.plan.fields.seo_slug') }}
                        </th>
                        <td>
                            {{ $plan->seo_slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.plans.index') }}">
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
            <a class="nav-link" href="#plan_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.suscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#plan_waiting_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.waitingList.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="plan_suscriptions">
            @includeIf('admin.plans.relationships.planSuscriptions', ['suscriptions' => $plan->planSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="plan_waiting_lists">
            @includeIf('admin.plans.relationships.planWaitingLists', ['waitingLists' => $plan->planWaitingLists])
        </div>
    </div>
</div>

@endsection