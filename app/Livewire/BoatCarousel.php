<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Boat;

class BoatCarousel extends Component
{
    public $images = [];

    public function mount()
    {
        $limit = 5;
        $this->images = Boat::inRandomOrder()->limit($limit)->get();
    }

    public function render()
    {
        return view('livewire.boat-carousel');
    }
}
