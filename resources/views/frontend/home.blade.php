@extends('layouts.frontend')

@section('content')
    <div class="container-fluid">

        @if (auth()->check() && auth()->user()->roles->contains('title', 'Admin'))
            <!-- Si el usuario tiene el rol 'Admin' -->
            @include('partials.smallmenu')
            <div class="row">
                @foreach ($wlistsNotDone as $wlnd)
                    <div class="col-12 col-sm-6 col-lg-4 p-1" data-priority="{{ $wlnd->priority }}">
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
                                    <a href="{{ route('frontend.wlists.show', $wlnd->id) }}"
                                        class="btn btn-sm btn-secondary">
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
                                @if ($wlnd->client_id)
                                    <p>
                                        <strong>Client:</strong>
                                        <a href="{{ route('frontend.clients.show', $wlnd->client_id) }}">
                                            {{ $wlnd->client->name . ' ' . $wlnd->client->lastname ?? '---' }}
                                        </a>
                                        <span class="float-right">
                                            @if ($wlnd->client->has_active_vip_plan == 1)
                                                <span class="badge badge-warning">VIP</span>
                                            @endif
                                            @if ($wlnd->client->has_active_maintenance_plan == 1)
                                                <span class="badge badge-success">PLAN</span>
                                            @endif
                                            @if ($wlnd->client->defaulter == 1)
                                                <span class="badge badge-danger">Defaulter</span>
                                            @endif
                                        </span>
                                    </p>
                                @endif
                                <p>
                                    <strong>Work description:</strong>
                                    @if ($wlnd->wlistWlogs->count() > 0)
                                        <span class="badge badge-light">{{ $wlnd->wlistWlogs->count() }} Wlogs
                                            ({{ $wlnd->wlistWlogs->sum('hours') ?? '0' }}h)
                                        </span>
                                    @else
                                        <span class="badge badge-light">Not started!</span>
                                    @endif
                                    <br>
                                    {{ $wlnd->description ?? '---' }}
                                    <span class="float-right">
                                        <!-- Icono para editar -->
                                        <a href="{{ route('frontend.wlists.edit', $wlnd->id) }}" class="edit-icon">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </span>
                                </p>
                                <!-- Barra de progreso -->
                                @php
                                    $estimatedHours = $wlnd->estimated_hours ?? 0;
                                    $workedHours = $wlnd->wlistWlogs->sum('hours') ?? 0;
                                    $percentage = 0;
                                    $overPercentage = 0;

                                    if ($estimatedHours > 0) {
                                        if ($workedHours <= $estimatedHours) {
                                            $percentage = ($workedHours / $estimatedHours) * 100;
                                            $overPercentage = 0;
                                        } else {
                                            $percentage = 100;
                                            $overPercentage =
                                                (($workedHours - $estimatedHours) / $estimatedHours) * 100;
                                        }
                                    } else {
                                        // Si no hay horas estimadas, mostrar el total de horas trabajadas como porcentaje completo
                                        $percentage = 0;
                                        $overPercentage = 0;
                                    }
                                @endphp

                                <div class="progress">
                                    @if ($percentage > 0)
                                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($percentage, 2) }}%
                                        </div>
                                    @endif
                                    @if ($overPercentage > 0)
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ $overPercentage }}%;" aria-valuenow="{{ $overPercentage }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($overPercentage, 2) }}% Over
                                        </div>
                                    @endif

                                </div>
                                Hours estimated {{ $wlnd->estimated_hours ?? '---' }}h, total worked hours
                                {{ $wlnd->wlistWlogs->sum('hours') ?? '0' }}h.

                                <div class="row">
                                    <!-- Due Date -->
                                    <div class="col-6">
                                        <strong>Due Date:</strong>
                                    </div>

                                    <div class="col-6">
                                        @php
                                            $deadline = $wlnd->deadline ?? null;
                                            $isPastDue = false;

                                            if ($deadline) {
                                                // Convertir la fecha del formato 'dd-mm-YYYY' a un objeto Carbon
                                                $deadlineDate = \Carbon\Carbon::createFromFormat('d-m-Y', $deadline);
                                                $isPastDue = $deadlineDate->isPast();
                                            }
                                        @endphp

                                        @if ($isPastDue)
                                            <span style="color: red;">{{ $deadline }}</span>
                                        @else
                                            {{ $deadline ?? '---' }}
                                        @endif
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
                                </div>


                            </div>

                            <!-- Dashcard Footer -->
                            <div class="dashcard-footer text-white">
                                <!-- Puerto donde está el barco y distancia -->
                                <p class="marina-info mb-0"
                                    data-marina-coordinates="{{ $wlnd->boat->marina->coordinates ?? '' }}">
                                    <strong>Marina:</strong>
                                    @if ($wlnd->boat && $wlnd->boat->marina)
                                        {{ $wlnd->boat->marina->name ?? '---' }}
                                        <!-- La distancia se agregará aquí por JavaScript -->
                                    @else
                                        ---
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Si no tiene el rol 'Admin' -->
            <h2>Welcome, {{ auth()->user()->name }}!</h2>
        @endif


    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLocation = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };

                // Depurar los datos de posición en el navegador
                console.log('Datos de posición obtenidos:', userLocation);

                // Obtener todos los elementos de las tarjetas
                var cardElements = document.querySelectorAll('.col-12.col-sm-6.col-lg-4.p-1');

                // Crear un array para almacenar las tarjetas con sus distancias y prioridades
                var cardsArray = [];

                cardElements.forEach(function(cardElement) {
                    var marinaInfo = cardElement.querySelector('.marina-info');
                    var marinaCoordinates = marinaInfo.getAttribute('data-marina-coordinates');

                    // Obtener la prioridad desde el atributo de datos
                    var priority = parseInt(cardElement.getAttribute('data-priority')) || 0;

                    if (marinaCoordinates) {
                        var coords = marinaCoordinates.split(',');

                        if (coords.length === 2) {
                            var marinaLat = parseFloat(coords[0]);
                            var marinaLng = parseFloat(coords[1]);

                            // Verificar que las coordenadas sean números válidos
                            if (!isNaN(marinaLat) && !isNaN(marinaLng)) {
                                // Calcular la distancia
                                var distancia = calcularDistancia(
                                    userLocation.latitude,
                                    userLocation.longitude,
                                    marinaLat,
                                    marinaLng
                                );

                                // Actualizar el contenido del elemento para mostrar la distancia
                                var existingHTML = marinaInfo.innerHTML;
                                marinaInfo.innerHTML = existingHTML + ' | ' + distancia.toFixed(
                                    2) + ' km away';

                                // Almacenar la distancia, prioridad y el elemento de la tarjeta
                                cardsArray.push({
                                    distance: distancia,
                                    priority: priority,
                                    element: cardElement
                                });
                            } else {
                                // Si las coordenadas no son válidas, asignar distancia infinita
                                cardsArray.push({
                                    distance: Infinity,
                                    priority: priority,
                                    element: cardElement
                                });
                            }
                        }
                    } else {
                        // Si no hay coordenadas, asignar distancia infinita
                        cardsArray.push({
                            distance: Infinity,
                            priority: priority,
                            element: cardElement
                        });
                    }
                });

                // Ordenar las tarjetas por distancia y prioridad
                cardsArray.sort(function(a, b) {
                    if (a.distance === b.distance) {
                        // Si las distancias son iguales, ordenar por prioridad descendente
                        return b.priority - a.priority;
                    } else {
                        // Ordenar por distancia ascendente
                        return a.distance - b.distance;
                    }
                });

                // Reordenar las tarjetas en el DOM
                var rowElement = document.querySelector('.container-fluid .row');
                // Limpiar las tarjetas existentes
                rowElement.innerHTML = '';

                // Agregar las tarjetas ordenadas
                cardsArray.forEach(function(card) {
                    rowElement.appendChild(card.element);
                });

            }, function(error) {
                console.error('Error al obtener la ubicación: ', error);
            });
        } else {
            console.log('La geolocalización no es compatible con este navegador.');
        }

        function calcularDistancia(lat1, lon1, lat2, lon2) {
            var R = 6371; // Radio de la Tierra en km
            var dLat = deg2rad(lat2 - lat1);
            var dLon = deg2rad(lon2 - lon1);
            var a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c; // Distancia en km
            return d;
        }

        function deg2rad(deg) {
            return deg * (Math.PI / 180)
        }

    });
</script>
