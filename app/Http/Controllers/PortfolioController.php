<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\ContentPage;

class PortfolioController extends Controller
{
    public function index()
    {
$pages = ContentPage::whereHas('categories', function($query) {
    $query->where('name', 'portfolio');
})->get();        return view('portfolio', compact('pages'));
    }
}
