@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.iotSuscription.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.iot-suscriptions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.is_active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $iotSuscription->is_active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.boats') }}
                                    </th>
                                    <td>
                                        @foreach($iotSuscription->boats as $key => $boats)
                                            <span class="label label-info">{{ $boats->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.plan') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->plan->plan_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.signed_contract') }}
                                    </th>
                                    <td>
                                        @if($iotSuscription->signed_contract)
                                            <a href="{{ $iotSuscription->signed_contract->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.hourly_rate_discount') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->hourly_rate_discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.material_discount') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->material_discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.device') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->device->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.link_description') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->link_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->notes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.internalnotes') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->internalnotes }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.completed_at') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->completed_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.iotSuscription.fields.financial_document') }}
                                    </th>
                                    <td>
                                        {{ $iotSuscription->financial_document->reference_number ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.iot-suscriptions.index') }}">
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