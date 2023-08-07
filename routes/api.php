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

Route::get('/events/{user_id}', [EventController::class, 'index']);
Route::get('/grid_calendar/{user_id}', [EventController::class, 'grid_calendar']);
Route::get('/edit-event/{id}', [EventController::class, 'edit']);
Route::post('/save-event/{user_id}', [EventController::class, 'saveEvent'])->name('save_event');
Route::delete('/delete-event/{eventId}', [EventController::class, 'deleteEvent']);
Route::post('/events/edit', [EventController::class, 'update'])->name('events.update');

