<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wlist; // Asegúrate de usar el modelo correcto para tu tabla 'wlist'

class HomeController
{
    public function index()
    {
        $progressing = Wlist::where('status_id', '=', 'progressing')
            ->orderBy('created_at', 'asc') // Order the records by the 'created_at' column in descending order
            ->get(); // Retrieve all records from the 'wlist' table

        $pending = Wlist::where('status_id', '=', 'pending')
            ->orderBy('created_at', 'asc') // Order the records by the 'created_at' column in descending order
            ->get(); // Retrieve all records from the 'wlist' table

        return view('frontend.home', compact('progressing', 'pending')); // Pass the records to the view
    }
}