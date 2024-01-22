@extends('layouts.frontend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <!-- Principal div: 12 columnas en desktop y 10 en pantallas más pequeñas -->
            <div class="col-lg-12 col-md-10">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">
                    @foreach ($wlists as $wlist)
                        <div class="col-12 col-md-6 col-lg- mt-2">
                            <div class="card custom-card">
                                <div class="card-body p-3 d-flex flex-row position-relative">
                                    <!-- ID Badge -->
                                    <div class="col-2 d-flex align-items-center justify-content-center custom-badge">
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
                                        class="col-2 d-flex flex-column align-items-center justify-content-start custom-elapsed-time">
                                        @php
                                            $elapsedDays = \Carbon\Carbon::now()->diffInDays($wlist->created_at);
                                        @endphp
                                        <span>{{ $elapsedDays }} days</span>
                                        <span>{{ strtoupper($wlist->type) }}</span>
                                        <span>{{ strtoupper($wlist->status) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Agrega los enlaces de paginación al final de la lista -->
                    <div class="pagination-wrapper flex justify-center m-3">
                        <nav class="flex" aria-label="Pagination Navigation">
                            <!-- Contenido de paginación aquí -->
                            {{ $wlists->links() }}

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    @endsection
