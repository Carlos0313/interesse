<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PrincipalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Eventos
Route::get('/events/getAll', [EventController::class,'getAllEvents']);
Route::post('/events/create', [EventController::class,'createEvent']);
Route::put('/events/update/{event_id}', [EventController::class,'updateEvent']);
Route::delete('/events/delete/{event_id}', [EventController::class,'deleteEvent']);

// Titulares
Route::get('/principal/getAll/{event_id}', [PrincipalController::class,'getAllTitulares']);
Route::post('/principal/create', [PrincipalController::class,'createTitular']);
Route::put('/principal/update/{titular_id}', [PrincipalController::class,'updateTitular']);
Route::delete('/principal/delete/{event_id}/{titular_id}', [PrincipalController::class,'deleteTitular']);

// Acompañantes
Route::get('/guest/getAll', [EventController::class,'getAllGuests']);
Route::post('/guest/create', [PrincipalController::class,'createGuest']);
Route::post('/guest/update/{guest_id}', [PrincipalController::class,'updateGuest']);
Route::delete('/guest/delete/{guest_id}', [PrincipalController::class,'deleteGuest']);