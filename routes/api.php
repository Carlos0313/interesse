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
Route::post('/events/create', [EventController::class,'createEvent']);
Route::post('/events/update/{event_id}', [EventController::class,'updateEvent']);
Route::delete('/events/delete/{event_id}', [EventController::class,'deleteEvent']);

// Titulares
Route::post('/principal/create', [PrincipalController::class,'createTitular']);
Route::post('/principal/update/{titular_id}', [PrincipalController::class,'updateTitular']);
Route::delete('/principal/delete/{titular_id}', [PrincipalController::class,'deleteTitular']);

// // Acompañantes
Route::post('/guest/create', [ProductController::class,'createEvent']);
Route::post('/guest/update/{guest_id}', [ProductController::class,'updateGuest']);
Route::delete('/guest/delete/{guest_id}', [ProductController::class,'deleteGuest']);