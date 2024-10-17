<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\FaqQuestion;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = FaqQuestion::all();
        return view('faq', compact('faqs'));
    }
}
