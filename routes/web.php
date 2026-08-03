<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

/*
|--------------------------------------------------------------------------
| Public Event Routes
|--------------------------------------------------------------------------
*/

Route::get('/events', [EventController::class, 'index'])
    ->name('events.index');

/*
|--------------------------------------------------------------------------
| Protected Event Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/my-events', [EventController::class, 'myEvents'])
        ->name('events.my');

    Route::get('/events/create', [EventController::class, 'create'])
        ->name('events.create');

    Route::post('/events', [EventController::class, 'store'])
        ->name('events.store');

    Route::get('/events/{event}/edit', [EventController::class, 'edit'])
        ->name('events.edit');

    Route::put('/events/{event}', [EventController::class, 'update'])
        ->name('events.update');

    Route::get('/events/{event}/registrations', [EventController::class, 'registrations'])
    ->name('events.registrations');

    Route::delete('/events/{event}', [EventController::class, 'destroy'])
        ->name('events.destroy');

});

/*
|--------------------------------------------------------------------------
| Event Details (KEEP THIS LAST!)
|--------------------------------------------------------------------------
*/

Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');

Route::post('/events/{event}/register', [RegistrationController::class, 'store'])
    ->name('registrations.store');    
/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/my-registrations', [RegistrationController::class, 'myRegistrations'])
        ->name('registrations.my');

});


Route::get(
    '/events/{event}/registrations/export',
    [EventController::class, 'exportRegistrations']
)->name('events.registrations.export');

require __DIR__.'/auth.php';

