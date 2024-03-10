@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.maintenanceSuscription.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.maintenance-suscriptions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.is_active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $maintenanceSuscription->is_active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.boats') }}
                                    </th>
                                    <td>
                                        @foreach($maintenanceSuscription->boats as $key => $boats)
                                            <span class="label label-info">{{ $boats->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.care_plan') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->care_plan->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.signed_contract') }}
                                    </th>
                                    <td>
                                        @if($maintenanceSuscription->signed_contract)
                                            <a href="{{ $maintenanceSuscription->signed_contract->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.hourly_rate_discount') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->hourly_rate_discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.material_discount') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->material_discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.link_description') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->link_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.internalnotes') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->internalnotes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.completed_at') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->completed_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.maintenanceSuscription.fields.financial_document') }}
                                    </th>
                                    <td>
                                        {{ $maintenanceSuscription->financial_document->reference_number ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.maintenance-suscriptions.index') }}">
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