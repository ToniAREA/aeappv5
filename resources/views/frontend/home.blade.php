@extends('layouts.frontend')

@section('content')
    <div class="container-fluid">
        <div class="dashcard mb-2">
            <div class="dashcard-content">
                <div class="row no-gutters">
                    <div class="col-4 p-1">
                        <div class="dashcard-button text-center">
                            <a href="{{ route('frontend.clients.index') }}">
                                {{ $clientsCount }}<br>
                                CLIENTS
                            </a>
                        </div>
                    </div>
                    <div class="col-4 p-1">
                        <div class="dashcard-button text-center">
                            <a href="{{ route('frontend.boats.index') }}">
                                {{ $boatsCount }}<br>
                                BOATS
                            </a>
                        </div>
                    </div>
                    <div class="col-4 p-1">
                        <div class="dashcard-button text-center">
                            <a href="{{ route('frontend.wlists.index') }}">
                                {{ $wlistsCount }}<br>
                                WLISTS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($wlistsNotDone as $wlnd)
                <div class="col-12 col-sm-6 col-lg-4 p-1">
                    <div class="dashcard">
                        <!-- Dashcard Header -->
                        <div class="dashcard-header">
                            <h2 class="dashcard-title">
                                <a href="{{ route('frontend.boats.show', $wlnd->boat_id) }}">
                                    {{ $wlnd->boat_namecomplete ?? '---' }}
                                </a>
                            </h2>
                            <!-- Botón para ver detalles -->
                            <div class="dashcard-header-button">
                                <a href="{{ route('frontend.wlists.show', $wlnd->id) }}" class="btn btn-sm btn-secondary">
                                    Details
                                </a>
                            </div>
                            <div class="dashcard-subtitle">
                                ID: {{ $wlnd->id }} &nbsp;|&nbsp;
                                @if ($wlnd->created_at)
                                    {{ $wlnd->created_at->diffInDays() }} days ago
                                @endif
                            </div>
                        </div>

                        <!-- Dashcard Body -->
                        <div class="dashcard-body">
                            <p>
                                <strong>Description:</strong>
                                {{ $wlnd->description ?? '---' }}
                            </p>
                            @if ($wlnd->client_id)
                                <p>
                                    <strong>Client:</strong>
                                    <a href="{{ route('frontend.clients.show', $wlnd->client_id) }}">
                                        {{ $wlnd->client->name ?? '---' }}
                                    </a>
                                </p>
                            @endif
                            <div class="row">
                                <!-- Due Date -->
                                <div class="col-6">
                                    <strong>Due Date:</strong>
                                </div>

                                <div class="col-6">
                                    {{ $wlnd->deadline ?? '---' }}
                                </div>


                                <!-- Priority -->
                                <div class="col-6">
                                    <strong>Priority:</strong>
                                </div>
                                <div class="col-6">
                                    {{ $wlnd->priority ?? '---' }}
                                </div>

                                <!-- Order Type -->
                                <div class="col-6">
                                    <strong>Order Type:</strong>
                                </div>
                                <div class="col-6">
                                    {{ ucfirst($wlnd->order_type) ?? '---' }}
                                </div>

                                <!-- Status -->
                                <div class="col-6">
                                    <strong>Status:</strong>
                                </div>
                                <div class="col-6">
                                    {{ $wlnd->status->name ?? '---' }}
                                </div>

                                <!-- Wlogs -->
                                <div class="col-6">
                                    <strong>Wlogs:</strong>
                                </div>
                                <div class="col-6">
                                    {{ $wlnd->wlistWlogs->count() }} logs
                                </div>
                            </div>
                        </div>

                        <!-- Dashcard Footer -->
                        <div class="dashcard-footer">
                            <!-- Puerto donde está el barco y distancia -->
                            <p>
                                <strong>Marina:</strong>
                                @if ($wlnd->boat && $wlnd->boat->marina)
                                    {{ $wlnd->boat->marina->name ?? '---' }}
                                    {{-- @if ($distance = calculateDistance($userLocation, $wlnd->boat->marina->location))
                                        &nbsp;|&nbsp; {{ $distance }} km away
                                    @endif --}}
                                @else
                                    ---
                                @endif
                            </p>

                            <!-- Icono para editar -->
                            <a href="{{ route('frontend.wlists.edit', $wlnd->id) }}" class="edit-icon">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
