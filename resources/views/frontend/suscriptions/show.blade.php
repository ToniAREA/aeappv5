@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.suscription.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.suscriptions.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $suscription->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $suscription->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.is_active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $suscription->is_active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.proforma') }}
                                    </th>
                                    <td>
                                        {{ $suscription->proforma->proforma_number ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $suscription->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.plan_name') }}
                                    </th>
                                    <td>
                                        {{ $suscription->plan_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.contract') }}
                                    </th>
                                    <td>
                                        @if($suscription->contract)
                                            <a href="{{ $suscription->contract->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.start_date') }}
                                    </th>
                                    <td>
                                        {{ $suscription->start_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.end_date') }}
                                    </th>
                                    <td>
                                        {{ $suscription->end_date }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.hourly_rate_discount') }}
                                    </th>
                                    <td>
                                        {{ $suscription->hourly_rate_discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.material_discount') }}
                                    </th>
                                    <td>
                                        {{ $suscription->material_discount }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.link') }}
                                    </th>
                                    <td>
                                        {{ $suscription->link }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.suscription.fields.link_description') }}
                                    </th>
                                    <td>
                                        {{ $suscription->link_description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.suscriptions.index') }}">
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