@extends('layouts.frontend')

@section('content')
    <div class="owncontainer">
        <!-- Logged users home/dashboard page -->

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="container">
            <div class="cards-container">

                <div class="dashcard">
                        <div class="dashcard-content">
                            <div class="dashcard-button"><a href="{{ route('frontend.clients.index')}}">{{ $clientsCount }}<br> CLIENTS</a></div>
                            <div class="dashcard-button"><a href="{{ route('frontend.boats.index')}}">{{ $boatsCount }}<br> BOATS</a></div>
                            <div class="dashcard-button"><a href="{{ route('frontend.wlists.index')}}">{{ $wlistsCount }}<br> WLISTS</a></div>
                        </div>
                </div>

                @foreach ($wlistsNotDone as $wlnd)
                    <div class="dashcard">
                        <div class="dashcard-content">
                            <div class="dashcard-number">{{ $wlnd->id }}</div>
                            <div class="dashcard-info">
                                <a href="{{ route('frontend.boats.show', $wlnd->boat->id) }}">
                                    <h2>{{ $wlnd->boat_namecomplete }}</h2>
                                </a>
                                <a href="{{ route('frontend.clients.show', $wlnd->client->id) }}">
                                    <h3>{{ $wlnd->client->name }}</h3>
                                </a>
                                <a href="{{ route('frontend.wlists.show', $wlnd->id) }}">
                                    <p>{{ $wlnd->description }}</p>
                                </a>
                            </div>
                            <div class="dashcard-progress">
                                <span class="text-center">{{ $wlnd->created_at->diffInDays() . ' days' }}</span>
                                <span class="text-center">{{ strtoupper($wlnd->order_type) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
