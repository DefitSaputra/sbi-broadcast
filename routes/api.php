<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BroadcastController; // <-- Jangan lupa import

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute untuk mendapatkan jadwal terkini dan selanjutnya
Route::get('/broadcast/schedule', [BroadcastController::class, 'getScheduleApi'])->name('api.broadcast.schedule');