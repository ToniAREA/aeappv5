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
                            <a href="/wlogs/create" class="btn btn-outline-secondary flex-fill text-center"
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
    @endsection
