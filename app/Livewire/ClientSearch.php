<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;

class ClientSearch extends Component
{
    public $search = '';

    public function render()
    {
        $clientsearch = Client::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('lastname', 'like', '%' . $this->search . '%')
            ->take(9)
            ->get();

        return view('livewire.client-search', ['clientsearch' => $clientsearch]);
    }
}
