<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wlist; // Asegúrate de usar el modelo correcto para tu tabla 'wlist'

class HomeController
{
    public function boot()
    {
        Paginator::useBootstrap(); // Habilita el uso de Bootstrap en la paginación
    }
    
    public function index()
    {
        $wlists = Wlist::paginate(10); // Recupera los registros de la tabla 'wlist' en bloques de 10 registros por página
        return view('frontend.home', compact('wlists')); // Pasa los registros a la vista
    }
}