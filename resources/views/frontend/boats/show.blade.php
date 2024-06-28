@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card custom-card m-0 mb-1">
                    <!-- Contenido de la tarjeta -->

                    <div class="card-header m-1">
                        <b>BOAT:</b> 334#
                        <b>MY MOONRAKER</b>
                        <a href="https://aeapp.es/boats">&lt;&lt;</a><br>

                        <a href="/marinas/14" class="custom-description-link">
                            <span class="custom-description mb-0">
                                Pantalán del Mediterrneo
                            </span><br>
                        </a>

                                                    <a href="/clients/140" class="custom-description-link">
                                <span class="custom-description mb-0">
                                    Y LANTIMAR Yachting SL  (España)
                                </span>
                            </a>
                                            </div>

                    <div class="card-body">
                        <div class="form-group">
                                                            <div class="text-center"> <!-- Add text-center class here -->
                                    <a href="https://www.marinetraffic.com/es/ais/details/ships/mmsi:518100968" target="_blank" rel="noopener noreferrer">
                                        <img class="img-thumbnail rounded mx-auto" style="max-height: 300px" src="https://photos.marinetraffic.com/ais/showphoto.aspx?mmsi=518100968" alt=" MOONRAKER"></a><br>
                                    <b>MMSI:</b> 518100968<br>
                                </div>
                                                    </div>


                        <div class="btn-group d-flex flex-wrap m-1">
                            <a href="/wlists/create?boat_id=334&amp;client_id=140&amp;marina_id=14" class="btn btn-outline-secondary flex-fill text-center" style="display: flex; align-items: center; justify-content: center;">
                                ADD<br>REQUEST
                            </a>
                            <a href="/wlogs/create" class="btn btn-outline-secondary flex-fill text-center" style="display: flex; align-items: center; justify-content: center;">
                                CHARGE<br>TIME
                            </a>
                            <a href="/wlogs/create" class="btn btn-outline-secondary flex-fill text-center" style="display: flex; align-items: center; justify-content: center;">
                                CHARGE<br>MATERIAL
                            </a>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card custom-card m-0 mb-1">
                    <div class="card-header m-1">
                        <b>WORKS NOT COMPLETED</b>
                    </div>
                    <div class="card-body d-flex flex-row position-relative">
                                                                                                                                                                                                                        </div>
                </div>
            </div>

            <div class="row justify-content-center my-2">
                                                                                                                                                        </div>

            <div class="col-md-7">
                <div class="card custom-card m-0" mb-1="">
                    <div class="card-header m-1">
                        <b>ALL WORKS LIST</b> = 2
                    </div>
                    <div class="card-body d-flex flex-row position-relative">
                                                    <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                                                                                                                                                                                                                                    </tbody>
                                </table>
                            </div>
                        
                    </div>
                </div>
            </div>

        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ $boat->id }}# {{ $boat->boat_type }} {{ $boat->name }}

                            <a class="btn btn-default" href="{{ route('frontend.boats.index') }}">
                                << </a>
                        </span>
                        @can('boat_edit')
                            <span>
                                <a class="btn btn-info btn-sm" href="{{ route('frontend.boats.edit', $boat->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                            </span>
                        @endcan

                    </div>

                    

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">

                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    {{-- <tr>
                                        <th>
                                            {{ trans('cruds.boat.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $boat->id }}
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <th>
                                            {{ trans('cruds.boat.fields.ref') }}
                                        </th>
                                        <td>
                                            {{ $boat->ref }}
                                        </td>
                                    </tr>
                                    {{-- <tr>
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
                                    </tr> --}}
                                    <tr>
                                        <th>
                                            {{ trans('cruds.boat.fields.boat_photo') }}
                                        </th>
                                        <td>
                                            @if ($boat->boat_photo)
                                                <a href="{{ $boat->boat_photo->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
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
                                            @foreach ($boat->clients as $key => $clients)
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
                                <a class="btn btn-default" href="{{ route('frontend.boats.index') }}">
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
