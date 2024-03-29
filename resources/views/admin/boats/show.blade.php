@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.boat.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.id') }}
                        </th>
                        <td>
                            {{ $boat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.ref') }}
                        </th>
                        <td>
                            {{ $boat->ref }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.boat_type') }}
                        </th>
                        <td>
                            {{ $boat->boat_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.name') }}
                        </th>
                        <td>
                            {{ $boat->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.boat_photo') }}
                        </th>
                        <td>
                            @if($boat->boat_photo)
                                <a href="{{ $boat->boat_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $boat->boat_photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.imo') }}
                        </th>
                        <td>
                            {{ $boat->imo }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.mmsi') }}
                        </th>
                        <td>
                            {{ $boat->mmsi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.marina') }}
                        </th>
                        <td>
                            {{ $boat->marina->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.sat_phone') }}
                        </th>
                        <td>
                            {{ $boat->sat_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.notes') }}
                        </th>
                        <td>
                            {{ $boat->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.internal_notes') }}
                        </th>
                        <td>
                            {{ $boat->internal_notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.clients') }}
                        </th>
                        <td>
                            @foreach($boat->clients as $key => $clients)
                                <span class="label label-info">{{ $clients->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.link') }}
                        </th>
                        <td>
                            {{ $boat->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.link_description') }}
                        </th>
                        <td>
                            {{ $boat->link_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.last_use') }}
                        </th>
                        <td>
                            {{ $boat->last_use }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.settings_data') }}
                        </th>
                        <td>
                            {{ $boat->settings_data }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.public_ip') }}
                        </th>
                        <td>
                            {{ $boat->public_ip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.coordinates') }}
                        </th>
                        <td>
                            {{ $boat->coordinates }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boats.index') }}">
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
            <a class="nav-link" href="#boat_wlists" role="tab" data-toggle="tab">
                {{ trans('cruds.wlist.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boat_appointments" role="tab" data-toggle="tab">
                {{ trans('cruds.appointment.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boat_booking_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.bookingList.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boat_mlogs" role="tab" data-toggle="tab">
                {{ trans('cruds.mlog.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boat_assets_rentals" role="tab" data-toggle="tab">
                {{ trans('cruds.assetsRental.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_clients" role="tab" data-toggle="tab">
                {{ trans('cruds.client.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_clients_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.clientsReview.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.suscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_maintenance_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.maintenanceSuscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_iot_suscriptions" role="tab" data-toggle="tab">
                {{ trans('cruds.iotSuscription.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#boats_waiting_lists" role="tab" data-toggle="tab">
                {{ trans('cruds.waitingList.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="boat_wlists">
            @includeIf('admin.boats.relationships.boatWlists', ['wlists' => $boat->boatWlists])
        </div>
        <div class="tab-pane" role="tabpanel" id="boat_appointments">
            @includeIf('admin.boats.relationships.boatAppointments', ['appointments' => $boat->boatAppointments])
        </div>
        <div class="tab-pane" role="tabpanel" id="boat_booking_lists">
            @includeIf('admin.boats.relationships.boatBookingLists', ['bookingLists' => $boat->boatBookingLists])
        </div>
        <div class="tab-pane" role="tabpanel" id="boat_mlogs">
            @includeIf('admin.boats.relationships.boatMlogs', ['mlogs' => $boat->boatMlogs])
        </div>
        <div class="tab-pane" role="tabpanel" id="boat_assets_rentals">
            @includeIf('admin.boats.relationships.boatAssetsRentals', ['assetsRentals' => $boat->boatAssetsRentals])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_clients">
            @includeIf('admin.boats.relationships.boatsClients', ['clients' => $boat->boatsClients])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_clients_reviews">
            @includeIf('admin.boats.relationships.boatsClientsReviews', ['clientsReviews' => $boat->boatsClientsReviews])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_suscriptions">
            @includeIf('admin.boats.relationships.boatsSuscriptions', ['suscriptions' => $boat->boatsSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_maintenance_suscriptions">
            @includeIf('admin.boats.relationships.boatsMaintenanceSuscriptions', ['maintenanceSuscriptions' => $boat->boatsMaintenanceSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_iot_suscriptions">
            @includeIf('admin.boats.relationships.boatsIotSuscriptions', ['iotSuscriptions' => $boat->boatsIotSuscriptions])
        </div>
        <div class="tab-pane" role="tabpanel" id="boats_waiting_lists">
            @includeIf('admin.boats.relationships.boatsWaitingLists', ['waitingLists' => $boat->boatsWaitingLists])
        </div>
    </div>
</div>

@endsection