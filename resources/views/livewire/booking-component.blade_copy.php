<!-- resources/views/livewire/booking-component.blade.php -->

<div class="text-center">
    <!-- Button Group for Duration -->
    <div class="btn-group mb-3" role="group" aria-label="Duration">
        <button type="button" class="btn {{ $duration == 2 ? 'btn-primary' : 'btn-secondary' }}"
            wire:click="$set('duration', 2)">2 hours</button>
        <button type="button" class="btn {{ $duration == 4 ? 'btn-primary' : 'btn-secondary' }}"
            wire:click="$set('duration', 4)">4 hours</button>
        <button type="button" class="btn {{ $duration == 6 ? 'btn-primary' : 'btn-secondary' }}"
            wire:click="$set('duration', 6)">6 hours</button>
    </div>



    {{-- Volcado del array $availabilities --}}
    {{-- <div class="m-1">
        @dump($availabilities)
        @dump($duration)
    </div> --}}


    @if (count($availabilities) > 0)
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($availabilities as $availability)
                    <div class="col-6 col-md-4 mb-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-body py-2">
                                <h6 class="card-title mb-0" style="font-weight: 500;">
                                    <span class="text-primary">
                                        {{ $availability->start_time }}

                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('l, d M') }}
                                        <!-- Solo Fecha -->
                                        <br> <!-- Salto de Línea -->
                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('H:i') }}
                                        <!-- Solo Hora -->
                                        -
                                        {{ \Carbon\Carbon::parse($availability->end_time)->format('H:i') }}
                                    </span>
                                </h6>
                                <p class="m-1 text-primary">
                                    <input type="radio" wire:model="selectedAvailability"
                                        value="{{ $availability->id }}" name="availability"> {{ $availability->id }}
                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p>No hay slots de disponibilidad para las opciones seleccionadas.</p>
    @endif

</div>
