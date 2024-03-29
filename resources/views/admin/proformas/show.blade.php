@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.proforma.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.proformas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.id') }}
                        </th>
                        <td>
                            {{ $proforma->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.proforma_number') }}
                        </th>
                        <td>
                            {{ $proforma->proforma_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.closed_and_protected') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $proforma->closed_and_protected ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.invoice_link') }}
                        </th>
                        <td>
                            {{ $proforma->invoice_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.client') }}
                        </th>
                        <td>
                            {{ $proforma->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.boats') }}
                        </th>
                        <td>
                            @foreach($proforma->boats as $key => $boats)
                                <span class="label label-info">{{ $boats->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.wlists') }}
                        </th>
                        <td>
                            @foreach($proforma->wlists as $key => $wlists)
                                <span class="label label-info">{{ $wlists->description }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.date') }}
                        </th>
                        <td>
                            {{ $proforma->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.description') }}
                        </th>
                        <td>
                            {{ $proforma->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.total_amount') }}
                        </th>
                        <td>
                            {{ $proforma->total_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.currency') }}
                        </th>
                        <td>
                            {{ $proforma->currency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.sent') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $proforma->sent ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.paid') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $proforma->paid ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.claims') }}
                        </th>
                        <td>
                            {{ $proforma->claims }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.link') }}
                        </th>
                        <td>
                            {{ $proforma->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.link_description') }}
                        </th>
                        <td>
                            {{ $proforma->link_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.status') }}
                        </th>
                        <td>
                            {{ $proforma->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.notes') }}
                        </th>
                        <td>
                            {{ $proforma->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $proforma->internal_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.proforma.fields.completed_at') }}
                        </th>
                        <td>
                            {{ $proforma->completed_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.proformas.index') }}">
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
            <a class="nav-link" href="#proforma_number_wlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.wlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_number_claims" role="tab" data-toggle="tab">
                {{ trans('cruds.claim.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_number_payments" role="tab" data-toggle="tab">
                {{ trans('cruds.payment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_number_mlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.mlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_assets_rentals" role="tab" data-toggle="tab">
                {{ trans('cruds.assetsRental.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_clients_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.clientsReview.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.suscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#proforma_maintenance_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.maintenanceSuscription.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="proforma_number_wlogs">
            @includeIf('admin.proformas.relationships.proformaNumberWlogs', ['wlogs' => $proforma->proformaNumberWlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_number_claims">
            @includeIf('admin.proformas.relationships.proformaNumberClaims', ['claims' => $proforma->proformaNumberClaims])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_number_payments">
            @includeIf('admin.proformas.relationships.proformaNumberPayments', ['payments' => $proforma->proformaNumberPayments])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_number_mlogs">
            @includeIf('admin.proformas.relationships.proformaNumberMlogs', ['mlogs' => $proforma->proformaNumberMlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_assets_rentals">
            @includeIf('admin.proformas.relationships.proformaAssetsRentals', ['assetsRentals' => $proforma->proformaAssetsRentals])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_clients_reviews">
            @includeIf('admin.proformas.relationships.proformaClientsReviews', ['clientsReviews' => $proforma->proformaClientsReviews])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_suscriptions">
            @includeIf('admin.proformas.relationships.proformaSuscriptions', ['suscriptions' => $proforma->proformaSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="proforma_maintenance_suscriptions">
            @includeIf('admin.proformas.relationships.proformaMaintenanceSuscriptions', ['maintenanceSuscriptions' => $proforma->proformaMaintenanceSuscriptions])
        </div>
    </div>
</div>

@endsection