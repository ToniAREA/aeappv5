@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.carePlan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.care-plans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.id') }}
                        </th>
                        <td>
                            {{ $carePlan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.is_online') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $carePlan->is_online ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.name') }}
                        </th>
                        <td>
                            {{ $carePlan->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.short_description') }}
                        </th>
                        <td>
                            {{ $carePlan->short_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.description') }}
                        </th>
                        <td>
                            {!! $carePlan->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.photo') }}
                        </th>
                        <td>
                            @if($carePlan->photo)
                                <a href="{{ $carePlan->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $carePlan->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.checkpoints') }}
                        </th>
                        <td>
                            @foreach($carePlan->checkpoints as $key => $checkpoints)
                                <span class="label label-info">{{ $checkpoints->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.period') }}
                        </th>
                        <td>
                            {{ App\Models\CarePlan::PERIOD_RADIO[$carePlan->period] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.period_price') }}
                        </th>
                        <td>
                            {{ $carePlan->period_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.seo_title') }}
                        </th>
                        <td>
                            {{ $carePlan->seo_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.seo_meta_description') }}
                        </th>
                        <td>
                            {{ $carePlan->seo_meta_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carePlan.fields.seo_slug') }}
                        </th>
                        <td>
                            {{ $carePlan->seo_slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.care-plans.index') }}">
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
            <a class="nav-link" href="#care_plan_maintenance_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.maintenanceSuscription.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="care_plan_maintenance_suscriptions">
            @includeIf('admin.carePlans.relationships.carePlanMaintenanceSuscriptions', ['maintenanceSuscriptions' => $carePlan->carePlanMaintenanceSuscriptions])
        </div>
    </div>
</div>

@endsection