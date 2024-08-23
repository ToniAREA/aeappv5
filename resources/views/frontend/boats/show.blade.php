@extends('layouts.frontend')
@section('content')
    <div class="container-fluid py-1">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card custom-card m-0 mb-1">
                    <!-- Contenido de la tarjeta -->

                    <div class="card-header m-1">
                        <b>BOAT:</b> {{ $boat->id }}#
                        <b>{{ $boat->boat_type }} {{ $boat->name }}</b>
                        <a href="{{ route('frontend.boats.index') }}">&lt;&lt;</a><br>

                        <a href="/marinas/{{ $boat->marina->id }}" class="custom-description-link">
                            <span class="custom-description mb-0">
                                {{ $boat->marina->name ?? '' }}
                            </span><br>
                        </a>

                        @foreach ($boat->clients as $key => $clients)
                            <a href="/clients/{{ $clients->id }}" class="custom-description-link">
                                <span class="custom-description mb-0">
                                    {{ $clients->name . ' ' . $clients->lastname . ' (' . $clients->country . ')' }}
                                </span>
                            </a>
                        @endforeach
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            @if (!empty($boat->mmsi))
                                <div class="text-center"> <!-- Add text-center class here -->
                                    <a href="https://www.marinetraffic.com/es/ais/details/ships/mmsi:{{ $boat->mmsi }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <img class="img-thumbnail rounded mx-auto" style="max-height: 300px"
                                            src="https://photos.marinetraffic.com/ais/showphoto.aspx?mmsi={{ $boat->mmsi }}"
                                            alt="{{ $boat->type . ' ' . $boat->name }}"></a><br>
                                    <b>MMSI:</b> {{ $boat->mmsi }}<br>
                                </div>
                            @endif
                        </div>


                        <div class="btn-group d-flex flex-wrap m-1">
                            <a href="/wlists/create?boat_id={{ $boat->id }}&client_id={{ $boat->clients->first()->id }}&marina_id={{ $boat->marina->id }}"
                                class="btn btn-outline-secondary flex-fill text-center"
                                style="display: flex; align-items: center; justify-content: center;">
                                ADD<br>REQUEST
                            </a>
                            <a href="/wlogs/create" class="btn btn-outline-secondary flex-fill text-center"
                                style="display: flex; align-items: center; justify-content: center;">
                                CHARGE<br>TIME
                            </a>
                            <a href="/mlogs/create" class="btn btn-outline-secondary flex-fill text-center"
                                style="display: flex; align-items: center; justify-content: center;">
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
                        @if (!empty($boat->boatWlists))
                            @foreach ($boat->boatWlists as $key => $wlist)
                                @if ($wlist->status !== 'completed')
                                    {{ $wlist->id }} {{ Str::limit($wlist->description, 50, '...') }}
                                    @php
                                        $elapsedDays = \Carbon\Carbon::now()->diffInDays($wlist->created_at);
                                    @endphp
                                    {{ $elapsedDays }} days<br>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row justify-content-center my-2">
                @if (!empty($boat->boatWlists))
                    @foreach ($boat->boatWlists as $key => $wlist)
                        @if ($wlist->status !== 'completed')
                            <div class="col-md-6">
                                <div class="card custom-card m-1">
                                    <div class="card-body d-flex flex-row position-relative">
                                        <!-- ID Badge -->
                                        <div class="col-2 d-flex align-items-center justify-content-center custom-badge"
                                            style="background-color: #57c559;">
                                            <span>{{ $wlist->id }}</span>
                                        </div>

                                        <!-- Boat Name and Description -->
                                        <div class="col-8 text-container">
                                            <a href="/wlists/{{ $wlist->id }}" class="custom-description-link">
                                                <p class="custom-description mb-0">
                                                    {{ Str::limit($wlist->description, 50, '...') }}
                                                </p>
                                            </a>
                                        </div>

                                        <!-- Elapsed Time in Days -->
                                        <div
                                            class="col-2 d-flex flex-column align-items-center justify-content-center custom-elapsed-time p-1 ts-4">
                                            @php
                                                $elapsedDays = \Carbon\Carbon::now()->diffInDays($wlist->created_at);
                                            @endphp
                                            <span>{{ $elapsedDays }} days</span>
                                            <span>{{ strtoupper($wlist->type) }}</span>
                                            <span
                                                style="font-size: smaller">{{ strtoupper(substr($wlist->status, 0, 8)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>

            <div class="col-md-7">
                <div class="card custom-card m-0"mb-1>
                    <div class="card-header m-1">
                        <b>ALL WORKS LIST</b> = {{ $boat->boatWlists->count() }}
                    </div>
                    <div class="card-body d-flex flex-row position-relative">
                        @if (!empty($boat->boatWlists))
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

                                        @foreach ($boat->boatWlists as $key => $wlist)
                                            @if ($wlist->status !== 'completed')
                                                <tr>
                                                    <td>{{ $wlist->id }}</td>
                                                    <td>{{ Str::limit($wlist->description, 50, '...') }}</td>
                                                    <td>{{ $wlist->status }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>

        <div class="container">

            <div class="row mt-2">
                <!-- Primera Columna -->
                <div class="col-md-6">
                    <div class="owncard">
                        <a href="{{ route('frontend.boats.index') }}">Back to boats list </a>

                        <h1>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#boatDetails"
                                aria-expanded="false" aria-controls="boatDetails">
                                <i class="fa fa-chevron-down"></i>
                            </button>
                            <a href="{{ route('frontend.boats.edit', $boat->id) }}">{{ $boat->id }}#
                                {{ $boat->boat_type }}
                                {{ $boat->name }}</a>
                        </h1>


                        <div id="boatDetails" class="collapse owncard-details">
                            @if (!empty($boat->mmsi))
                                <div class="owncard-row mt-2">
                                    <div class="owncard-field">
                                        <a href="https://www.marinetraffic.com/es/ais/details/ships/mmsi:{{ $boat->mmsi }}"
                                            target="_blank">
                                            <img class="img-thumbnail rounded mx-auto"
                                                style="max-height: 300px; align-self: center;"
                                                src="https://photos.marinetraffic.com/ais/showphoto.aspx?mmsi={{ $boat->mmsi }}"
                                                alt="{{ $boat->type . ' ' . $boat->name }}">
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.ref') }}</b>
                                    <span>{{ $boat->ref }}</span>
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.boat_type') }}</b>
                                    <span>{{ $boat->boat_type }}</span>
                                </div>
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.name') }}</b>
                                    <span>{{ $boat->name }}</span>
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.imo') }}</b>
                                    <span>{{ $boat->imo }}</span>
                                </div>
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.mmsi') }}</b>
                                    <span>{{ $boat->mmsi }}</span>
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.marina') }}</b>
                                    <span>{{ $boat->marina->name ?? '' }}</span>
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.sat_phone') }}</b>
                                    <span>{{ $boat->sat_phone }}</span>
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.notes') }}</b>
                                    <textarea readonly>{{ $boat->notes }}</textarea>
                                </div>
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.internal_notes') }}</b>
                                    <textarea readonly>{{ $boat->internal_notes }}</textarea>
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.clients') }}</b>
                                    @foreach ($boat->clients as $key => $clients)
                                        <span class="label label-info">{{ $clients->name }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.link') }}</b>
                                    <a href="{{ $boat->link }}" class="contact-badge">{{ $boat->link_description }}</a>
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.last_use') }}</b>
                                    <span>{{ $boat->last_use }}</span>
                                </div>
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.settings_data') }}</b>
                                    <span>{{ $boat->settings_data }}</span>
                                </div>
                            </div>

                            <div class="owncard-row">
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.public_ip') }}</b>
                                    <span>{{ $boat->public_ip }}</span>
                                </div>
                                <div class="owncard-field">
                                    <b>{{ trans('cruds.boat.fields.coordinates') }}</b>
                                    <span>{{ $boat->coordinates }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Segunda Columna -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h2>Owner Details</h2>
                        </div>
                        <div class="card-body">
                            <div id="accordion">
                                <!-- Owner Information Section -->
                                <div class="card">
                                    <div class="card-header" id="headingOwnerDetails">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseOwnerDetails" aria-expanded="false"
                                                aria-controls="collapseOwnerDetails">
                                                Owner Information
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOwnerDetails" class="collapse" aria-labelledby="headingOwnerDetails"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <p><strong>Owner Name:</strong> Client name</p>
                                            <p><strong>Contact:</strong> Client contact</p>
                                            <!-- Agrega más detalles del dueño según sea necesario -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Additional Sections as needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="owncontainer">
                <div class="owncard">
                    <div class="owncard-row">
                        <div class="owncard-field">
                            <b>{{ 'WLISTS = ' . $boat->boatWlists->count() }}</b>
                            @foreach ($boat->boatWlists as $wlist)
                                <span>{{ ($wlist->status->name ?? 'N/A') . ' ' . ($wlist->id ?? 'N/A') . '# ' . ($wlist->description ?? 'No description available') }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Optional JavaScript to toggle icon -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleButton = document.querySelector('[data-toggle="collapse"]');
                toggleButton.addEventListener('click', function() {
                    const icon = toggleButton.querySelector('i');
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');
                });
            });
        </script>
    @endsection
