<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\RecurringBroadcastController; // <-- Import controller baru

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute untuk mendapatkan jadwal siaran terjadwal (event)
Route::get('/broadcast/schedule', [BroadcastController::class, 'getScheduleApi'])->name('api.broadcast.schedule');

// Rute baru untuk mendapatkan jadwal siaran berulang (recurring)
Route::get('/recurring/schedule', [RecurringBroadcastController::class, 'getScheduleApi'])->name('api.recurring.schedule');