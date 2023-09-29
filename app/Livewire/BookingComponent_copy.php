<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Availability;
use Carbon\Carbon;

class BookingComponent extends Component
{
    public $duration = 2; // Inicializado a 2 horas
    public $availabilities = [];
    public $selectedAvailability;

    public function mount()
    {
        $this->loadAvailabilities();
    }

    public function updated($propertyName)
    {
        $this->loadAvailabilities();
    }

    public function loadAvailabilities()
    {
        $this->availabilities = collect(); // Inicializar como una colección vacía

        $originalAvailabilities = Availability::whereRaw("TIMESTAMPDIFF(HOUR, start_time, end_time) >= ?", [$this->duration])
            ->orderBy('start_time')
            ->get();

        foreach ($originalAvailabilities as $availability) {
            $startTime = Carbon::parse($availability->start_time); // Asegurarte de que es una instancia de Carbon
            $endTime = Carbon::parse($availability->end_time); // Asegurarte de que es una instancia de Carbon

            while ($startTime->addHours($this->duration) <= $endTime) {
                $slot = new \stdClass;
                $slot->id = $availability->id;
                $slot->start_time = $startTime->copy();
                $slot->end_time = $startTime->copy()->addHours($this->duration);
                $this->availabilities->push($slot);
            }
        }
    }

    public function addToCart($availabilityId)
    {
        // Aquí va tu lógica para añadir la disponibilidad seleccionada al carrito de la compra
    }

    public function render()
    {
        return view('livewire.booking-component', ['availabilities' => $this->availabilities]);
    }
}
