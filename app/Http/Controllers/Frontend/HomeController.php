<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Wlist;
use App\Models\Client;
use App\Models\Boat;

use Gate;

class HomeController
{
    public function index()
    {
        /* abort_if(Gate::denies('home_access'), Response::HTTP_FORBIDDEN, '403 Forbidden'); */

        $wlistsNotDone = Wlist::all();
        $clientsCount = Client::count();
        $boatsCount = Boat::count();
        $wlistsCount = Wlist::count();

        return view('frontend.home', compact('wlistsNotDone', 'clientsCount', 'boatsCount', 'wlistsCount'));
    }
}
