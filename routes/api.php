<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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
Route::get('/events/getAll', [EventController::class,'getEvent']);
Route::post('/events/create', [EventController::class,'createEvent']);
Route::post('/events/update/{event_id}', [EventController::class,'updateEvent']);
Route::delete('/events/delete/{event_id}', [EventController::class,'deleteEvent']);

// Titulares
// Route::get('/events/getAll', [EventController::class,'getEvent']);
// Route::post('/events/create', [ProductController::class,'createEvent']);
// Route::post('/events/update/{event_id}', [ProductController::class,'updateEvent']);
// Route::delete('/events/delete/{event_id}', [ProductController::class,'deleteEvent']);

// // Acompañantes
// Route::get('/events/getAll', [EventController::class,'getEvent']);
// Route::post('/events/create', [ProductController::class,'createEvent']);
// Route::post('/events/update/{event_id}', [ProductController::class,'updateEvent']);
// Route::delete('/events/delete/{event_id}', [ProductController::class,'deleteEvent']);