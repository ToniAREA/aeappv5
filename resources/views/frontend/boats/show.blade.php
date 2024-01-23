@extends('layouts.frontend')
@section('content')
    <div class="container-fluid py-1">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card m-0">
                    <!-- Contenido de la tarjeta -->
                    <div class="card-header">
                        <b>BOAT:</b> {{ $boat->id }}#
                        <b>{{ $boat->boat_type }} {{ $boat->name }}</b><br>

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
                                        target="_blank">
                                        <img class="img-thumbnail rounded mx-auto" style="max-height: 300px"
                                            src="https://photos.marinetraffic.com/ais/showphoto.aspx?mmsi={{ $boat->mmsi }}"
                                            alt="{{ $boat->type . ' ' . $boat->name }}"></a><br>
                                    <b>MMSI:</b> {{ $boat->mmsi }}<br>
                                </div>
                            @endif
                            <a class="btn btn-default" href="{{ route('frontend.boats.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-7">
                <div class="card custom-card m-1">
                    <div class="card-body d-flex flex-row position-relative">
                    </div>
                </div>
            </div>

            <div class="row justify-content-center my-2">
                @if (!empty($boat->boatWlists))
                    @foreach ($boat->boatWlists as $key => $wlist)
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
                    @endforeach
                @endif
            </div>

        </div>
    </div>
@endsection
