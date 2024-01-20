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
                        <!-- Tarjetas: 4 columnas en desktop, 2 en tablet y 1 en móvil -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card m-1">
                                <div class="card-header">
                                    <a href="">{{ $wlist->client['name'] ?? '-' }}, {{ $wlist->client['lastname'] ?? '-' }}</a>

                                </div>
                                <div class="card-body">
                                    <p>{{ $wlist->description }}</p>
                                    <p>{{ $wlist->created_at }}</p>
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
