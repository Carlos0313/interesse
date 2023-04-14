<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\GuestController;


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
Route::post('/guest/create', [GuestController::class,'createGuest']);
Route::put('/guest/update/{guest_id}', [GuestController::class,'updateGuest']);
Route::delete('/guest/delete/{asistencia_id}', [GuestController::class,'deleteGuest']);
Route::post('/guest/import', [GuestController::class,'importGuest']);