<?php

namespace App\Livewire;

use App\Models\Boat;
use Livewire\Component;

class BoatCarousel extends Component
{
    public $boats;

    public function mount()
    {
    
        $this->boats = Boat::all();
    
        $someVariable = 'Hello, World!';   }

    public function render()
    {
        return view('livewire.boat-carousel', ['someVariable' => $someVariable]);
    }
}
