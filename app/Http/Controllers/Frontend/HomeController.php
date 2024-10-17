<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wlist;
use App\Models\Client;
use App\Models\Boat;

class HomeController extends Controller
{
    public function index()
    {
        /* abort_if(Gate::denies('home_access'), Response::HTTP_FORBIDDEN, '403 Forbidden'); */

        // Obtener la ubicación del usuario desde la sesión o cualquier otro método
        $userLocation = session('userLocation'); // ['latitude' => float, 'longitude' => float]

        $wlistsNotDone = Wlist::with('client', 'status')
            ->whereHas('status', function ($query) {
                $query->where('name', '=', 'pending');
            })->get();

        $clientsCount = Client::count();
        $boatsCount = Boat::count();
        $wlistsCount = Wlist::count();

        return view('frontend.home', compact('wlistsNotDone', 'clientsCount', 'boatsCount', 'wlistsCount', 'userLocation'));
    }

}