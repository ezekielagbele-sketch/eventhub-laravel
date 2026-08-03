<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
   public function index()
{
    $featuredEvent = Event::with('category')
        ->latest()
        ->first();

    $events = Event::with('category')
        ->latest()
        ->skip(1)
        ->take(6)
        ->get();

    return view('home', compact(
        'featuredEvent',
        'events'
    ));
}
}