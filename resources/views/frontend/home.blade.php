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

            <!-- Lista de WLists no completadas -->
            @foreach ($wlistsNotDone as $wlnd)
                <div class="col-12 col-sm-6 col-lg-4 p-1">
                    <div class="dashcard">
                        <div class="dashcard-content">
                            @if ($wlnd)
                                <div class="dashcard-number">{{ $wlnd->id }}</div>

                                @if ($wlnd->boat_id)
                                    <h2>
                                        <a href="{{ route('frontend.boats.show', $wlnd->boat_id) }}">
                                            {{ $wlnd->boat_namecomplete ?? '---' }}
                                        </a>
                                    </h2>
                                @endif

                                @if ($wlnd->client_id)
                                    <h3>
                                        <a href="{{ route('frontend.clients.show', $wlnd->client_id) }}">
                                            {{ $wlnd->client->name ?? '---' }}
                                        </a>
                                    </h3>
                                @endif

                                <p>
                                    <a href="{{ route('frontend.wlists.show', $wlnd->id) }}">
                                        {{ $wlnd->description ?? '---' }}
                                    </a>
                                </p>
                            @endif

                            <div class="dashcard-progress">
                                <span>
                                    <!-- Días desde la creación -->
                                    @if ($wlnd->created_at)
                                        {{ $wlnd->created_at->diffInDays() . ' días' }}
                                    @endif
                                </span>
                                <span>
                                    <!-- Tipo de orden en mayúsculas -->
                                    {{ strtoupper($wlnd->order_type ?? 'Tipo de orden no disponible') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
