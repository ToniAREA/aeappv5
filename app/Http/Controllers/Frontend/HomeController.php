<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wlist; // Asegúrate de usar el modelo correcto para tu tabla 'wlist'

class HomeController
{
    public function index()
    {
        $wlists = Wlist::where('status', '=', 'progressing')
            ->orderBy('created_at', 'desc') // Order the records by the 'created_at' column in descending order
            ->paginate(20); // Retrieve records from the 'wlist' table in blocks of 20 records per page
        return view('frontend.home', compact('wlists')); // Pass the records to the view
    }
}