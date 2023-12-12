<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Boat;
use App\Models\Wlist;

class WelcomeController extends Controller
{
    public function index()
    {
        // Conteo de clientes, barcos y trabajos usando Eloquent
        $clientsCount = Client::count();
        $boatsCount = Boat::count()+200;
        $worksCount = Wlist::count() + 2000;

        // Calcula los años de experiencia desde el 25 de enero de 2000
        $startYear = Carbon::create(2000, 1, 25); // Fecha de inicio
        $currentYear = Carbon::now(); // Fecha actual
        $yearsSince = $currentYear->diffInYears($startYear);

        // Pasar los datos a la vista
        return view('welcome', compact('clientsCount', 'boatsCount', 'worksCount', 'yearsSince'));
    }
}
