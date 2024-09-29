@extends('layouts.frontend')
@section('content')
    <div class="container-fluid py-1">
        <!-- Fila principal que contiene todos los cards -->
        <div class="row justify-content-center">
            <!-- Primer Card -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card custom-card m-1 mb-1">
                    <!-- Contenido del primer card -->
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
                        <!-- Contenido del cuerpo del card -->
                        @if (!empty($boat->mmsi))
                            <div class="text-center">
                                <a href="https://www.marinetraffic.com/es/ais/details/ships/mmsi:{{ $boat->mmsi }}"
                                    target="_blank" rel="noopener noreferrer">
                                    <img class="img-thumbnail rounded mx-auto" style="max-height: 300px"
                                        src="https://photos.marinetraffic.com/ais/showphoto.aspx?mmsi={{ $boat->mmsi }}"
                                        alt="{{ $boat->type . ' ' . $boat->name }}"></a><br>
                                <b>MMSI:</b> {{ $boat->mmsi }}<br>
                            </div>
                        @endif

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
                        <!-- Dashcard Footer -->
                        <div class="dashcard-footer text-white">
                            <!-- Puerto donde está el barco y distancia -->
                            <p class="marina-info" data-marina-coordinates="{{ $boat->marina->coordinates ?? '' }}">
                                <strong>Marina:</strong>
                                @if ($boat && $boat->marina)
                                    {{ $boat->marina->name ?? '---' }}
                                    <!-- Aquí agregaremos la distancia desde JavaScript -->
                                @else
                                    ---
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4 p-1">
                    <div class="dashcard">
                        <!-- Dashcard Header -->
                        <div class="dashcard-header">
                            <h2 class="dashcard-title">
                                <a href="{{ route('frontend.boats.show', $boat->id) }}">
                                    {{ $boat_namecomplete ?? '---' }}
                                </a>
                            </h2>
                            <!-- Botón para ver detalles -->
                            <div class="dashcard-header-button">
                                <a href="{{ route('frontend.wlists.show', $boat->id) }}" class="btn btn-sm btn-secondary">
                                    Details
                                </a>
                            </div>
                            <div class="dashcard-subtitle">
                                ID: {{ $boat->id }} &nbsp;|&nbsp;
                                
                            </div>
                        </div>

                        <!-- Dashcard Body -->
                        <div class="dashcard-body">
                            <p>
                                <strong>Work description:</strong><br>
                                {{ $description ?? '---' }}
                            </p>
                            
                            <div class="row">
                                <!-- Due Date -->
                                <div class="col-6">
                                    <strong>Due Date:</strong>
                                </div>

                                <div class="col-6">
                                    {{ $deadline ?? '---' }}
                                </div>

                                <!-- Priority -->
                                <div class="col-6">
                                    <strong>Priority:</strong>
                                </div>
                                <div class="col-6">
                                    {{ $priority ?? '---' }}
                                </div>

                                <!-- Order Type -->
                                <div class="col-6">
                                    <strong>Order Type:</strong>
                                </div>
                                <div class="col-6">
                                    
                                </div>

                                <!-- Status -->
                                <div class="col-6">
                                    <strong>Status:</strong>
                                </div>
                                <div class="col-6">
                                    
                                </div>

                                <!-- Wlogs -->
                                <div class="col-6">
                                    <strong>Wlogs:</strong>
                                </div>
                                <div class="col-6">
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Dashcard Footer -->
                        <div class="dashcard-footer text-white">
                            <!-- Puerto donde está el barco y distancia -->
                            <p class="marina-info" data-marina-coordinates="{{ $boat->marina->coordinates ?? '' }}">
                                <strong>Marina:</strong>
                                @if ($boat && $boat->marina)
                                    {{ $boat->marina->name ?? '---' }}
                                    <!-- Aquí agregaremos la distancia desde JavaScript -->
                                @else
                                    ---
                                @endif
                            </p>

                            <!-- Icono para editar -->
                            <a href="" class="edit-icon">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>

            <!-- Segundo Card -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card custom-card m-1 mb-1">
                    <div class="card-header m-1">
                        <b>WORKS NOT COMPLETED</b>
                    </div>
                    <div class="card-body">
                        @if (!empty($boat->boatWlists))
                            @foreach ($boat->boatWlists as $wlist)
                                @if ($wlist->status !== 'completed')
                                    <p>
                                        {{ $wlist->id }} - {{ Str::limit($wlist->description, 50, '...') }}
                                        ({{ \Carbon\Carbon::now()->diffInDays($wlist->created_at) }} days)
                                    </p>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tercer Card -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card custom-card m-1 mb-1">
                    <div class="card-header m-1">
                        <b>ALL WORKS LIST</b> = {{ $boat->boatWlists->count() }}
                    </div>
                    <div class="card-body">
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
                                        @foreach ($boat->boatWlists as $wlist)
                                            <tr>
                                                <td>{{ $wlist->id }}</td>
                                                <td>{{ Str::limit($wlist->description, 50, '...') }}</td>
                                                <td>{{ $wlist->status }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cards adicionales (si los hay) -->
            @if (!empty($boat->boatWlists))
                @foreach ($boat->boatWlists as $wlist)
                    @if ($wlist->status !== 'completed')
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card custom-card m-1">
                                <div class="card-body">
                                    <!-- Contenido del card -->
                                    <div class="d-flex">
                                        <!-- ID del Wlist -->
                                        <div class="flex-shrink-0">
                                            <span class="badge badge-success">{{ $wlist->id }}</span>
                                        </div>
                                        <!-- Descripción y detalles -->
                                        <div class="flex-grow-1 ms-3">
                                            <a href="/wlists/{{ $wlist->id }}" class="custom-description-link">
                                                <p class="custom-description mb-0">
                                                    {{ Str::limit($wlist->description, 50, '...') }}
                                                </p>
                                            </a>
                                            <small>
                                                {{ \Carbon\Carbon::now()->diffInDays($wlist->created_at) }} days -
                                                {{ strtoupper($wlist->type) }} -
                                                {{ strtoupper(substr($wlist->status, 0, 8)) }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <!-- Sección adicional si es necesario -->
        <!-- Puedes agregar más filas y cards siguiendo el mismo patrón -->
    </div>
@endsection