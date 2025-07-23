<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\RecurringBroadcastController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan rute API untuk aplikasi Anda. Rute
| ini dimuat oleh RouteServiceProvider dalam grup yang
| diberi middleware "api". Nikmati membangun API Anda!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute API untuk mendapatkan jadwal SIARAN TETAP (SEKALI JALAN)
Route::get('/schedule', [BroadcastController::class, 'getScheduleApi'])->name('api.broadcast.schedule');

// Dalam controller Laravel Anda, pastikan route API tersedia:
Route::get('/recurring-broadcast/current', [RecurringBroadcastController::class, 'getScheduleApi'])
    ->name('api.recurring-broadcast.current');