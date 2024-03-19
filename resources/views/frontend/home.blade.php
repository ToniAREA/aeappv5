@extends('layouts.frontend')

@section('content')
    <div class="container-fluid">

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card custom-card">
                    <div class="card-header bg-secondary text-white">
                        <a href="/clients" class="btn btn-link text-white"><i class="fa fa-users"></i> {{ $clientscount }}
                            CLIENTS</a>
                    </div>
                    <div class="card-body">Cuerpo</div>
                    <div class="card-footer">Pie de página</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card custom-card">
                    <div class="card-header bg-secondary text-white">
                        <a href="/boats" class="btn btn-link text-white"><i class="fa fa-ship"></i> {{ $boatscount }}
                            BOATS</a>
                    </div>
                    <div class="card-body">Cuerpo</div>
                    <div class="card-footer">Pie de página</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card custom-card">
                    <div class="card-header bg-secondary text-white">
                        <a href="/marinas" class="btn btn-link text-white"><i class="fa fa-anchor"></i> {{ $marinascount }}
                            MARINAS</a>
                    </div>
                    <div class="card-body">Cuerpo</div>
                    <div class="card-footer">Pie de página</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card custom-card">
                    <div class="card-header bg-secondary text-white">
                        <a href="/wlists" class="btn btn-link text-white"><i class="fa fa-briefcase"></i>
                            {{ $wlistscount }} WLISTS</a>
                    </div>
                    <div class="card-body">Cuerpo</div>
                    <div class="card-footer">Pie de página</div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card custom-card">
                    <div class="card-header bg-secondary text-white">
                        <a href="/wlogs" class="btn btn-link text-white"><i class="fa fa-briefcase"></i>
                            {{ $wlogscount }} WLOGS</a>
                    </div>
                    <div class="card-body">Cuerpo</div>
                    <div class="card-footer">Pie de página</div>
                </div>
            </div>

        </div>

        <div class="row">
            HERE GOES:
            @foreach ($progressing as $wlist)
                <div class="col-sm-12 col-md-6 col-lg-4 ">
                    <div class="card custom-card m-1">
                        <div class="card-body d-flex flex-row position-relative">
                            <!-- ID Badge -->
                            <div class="col-2 d-flex align-items-center justify-content-center custom-badge"
                                style="background-color: #57c559;">
                                <a href="/wlists/{{ $wlist->id }}" class="custom-description-link"
                                    style="color: white;"><span>{{ $wlist->id }}</span></a>
                            </div>

                            <!-- Boat Name and Description -->
                            <div class="col-8 text-container">
                                <a href="/boats/{{ $wlist->boat['id'] }}" class="custom-link d-block mb-1">
                                    <h2 class="h6 mb-0 custom-title">{{ $wlist->boat_namecomplete }}</h2>
                                </a>

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
                                <span style="font-size: smaller">{{ strtoupper(substr($wlist->status, 0, 8)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            @foreach ($pending as $wlist)
                <div class="col-sm-12 col-md-6 col-lg-4 ">
                    <div class="card custom-card m-1">
                        <div class="card-body d-flex flex-row position-relative">
                            <!-- ID Badge -->
                            <div class="col-2 d-flex align-items-center justify-content-center custom-badge"
                                style="background-color: #303230;">
                                <span>{{ $wlist->id }}</span>
                            </div>

                            <!-- Boat Name and Description -->
                            <div class="col-8 text-container">
                                <a href="/boats/{{ $wlist->boat['id'] }}" class="custom-link d-block mb-1">
                                    <h2 class="h6 mb-0 custom-title">{{ $wlist->boat_namecomplete }}</h2>
                                </a>
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
                                <span style="font-size: smaller">{{ strtoupper(substr($wlist->status, 0, 8)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
