@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.client.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.id') }}
                        </th>
                        <td>
                            {{ $client->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.has_active_vip_plan') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $client->has_active_vip_plan ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.has_active_maintenance_plan') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $client->has_active_maintenance_plan ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.defaulter') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $client->defaulter ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.ref') }}
                        </th>
                        <td>
                            {{ $client->ref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.name') }}
                        </th>
                        <td>
                            {{ $client->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.lastname') }}
                        </th>
                        <td>
                            {{ $client->lastname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.vat') }}
                        </th>
                        <td>
                            {{ $client->vat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.address') }}
                        </th>
                        <td>
                            {{ $client->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.country') }}
                        </th>
                        <td>
                            {{ $client->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.telephone') }}
                        </th>
                        <td>
                            {{ $client->telephone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.mobile') }}
                        </th>
                        <td>
                            {{ $client->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.email') }}
                        </th>
                        <td>
                            {{ $client->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.contacts') }}
                        </th>
                        <td>
                            @foreach($client->contacts as $key => $contacts)
                                <span class="label label-info">{{ $contacts->contact_first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.boats') }}
                        </th>
                        <td>
                            @foreach($client->boats as $key => $boats)
                                <span class="label label-info">{{ $boats->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.notes') }}
                        </th>
                        <td>
                            {{ $client->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $client->internal_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.coordinates') }}
                        </th>
                        <td>
                            {{ $client->coordinates }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.link_a') }}
                        </th>
                        <td>
                            {{ $client->link_a }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.link_a_description') }}
                        </th>
                        <td>
                            {{ $client->link_a_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.link_b') }}
                        </th>
                        <td>
                            {{ $client->link_b }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.link_b_description') }}
                        </th>
                        <td>
                            {{ $client->link_b_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.client.fields.last_use') }}
                        </th>
                        <td>
                            {{ $client->last_use }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.clients.index') }}">
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
            <a class="nav-link" href="#client_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_booking_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.bookingList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_assets_rentals" role="tab" data-toggle="tab">
                {{ trans('cruds.assetsRental.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_clients_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.clientsReview.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.suscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_maintenance_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.maintenanceSuscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#from_client_employee_ratings" role="tab" data-toggle="tab">
                {{ trans('cruds.employeeRating.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_iot_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.iotSuscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_finalcial_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.finalcialDocument.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#client_waiting_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.waitingList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#clients_boats" role="tab" data-toggle="tab">
                {{ trans('cruds.boat.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="client_wlists">
            @includeIf('admin.clients.relationships.clientWlists', ['wlists' => $client->clientWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_appointments">
            @includeIf('admin.clients.relationships.clientAppointments', ['appointments' => $client->clientAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_booking_lists">
            @includeIf('admin.clients.relationships.clientBookingLists', ['bookingLists' => $client->clientBookingLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_assets_rentals">
            @includeIf('admin.clients.relationships.clientAssetsRentals', ['assetsRentals' => $client->clientAssetsRentals])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_clients_reviews">
            @includeIf('admin.clients.relationships.clientClientsReviews', ['clientsReviews' => $client->clientClientsReviews])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_suscriptions">
            @includeIf('admin.clients.relationships.clientSuscriptions', ['suscriptions' => $client->clientSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_maintenance_suscriptions">
            @includeIf('admin.clients.relationships.clientMaintenanceSuscriptions', ['maintenanceSuscriptions' => $client->clientMaintenanceSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="from_client_employee_ratings">
            @includeIf('admin.clients.relationships.fromClientEmployeeRatings', ['employeeRatings' => $client->fromClientEmployeeRatings])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_iot_suscriptions">
            @includeIf('admin.clients.relationships.clientIotSuscriptions', ['iotSuscriptions' => $client->clientIotSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_finalcial_documents">
            @includeIf('admin.clients.relationships.clientFinalcialDocuments', ['finalcialDocuments' => $client->clientFinalcialDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="client_waiting_lists">
            @includeIf('admin.clients.relationships.clientWaitingLists', ['waitingLists' => $client->clientWaitingLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="clients_boats">
            @includeIf('admin.clients.relationships.clientsBoats', ['boats' => $client->clientsBoats])
        </div>
    </div>
</div>

@endsection