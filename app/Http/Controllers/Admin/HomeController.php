<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        $clientscount = \App\Models\Client::count();
        $boatscount = \App\Models\Boat::count();
        $wlistscount = \App\Models\Wlist::count();
        $wlogscount = \App\Models\Wlog::count();

        return view('home', compact('clientscount', 'boatscount', 'wlistscount', 'wlogscount'));
    }
}
