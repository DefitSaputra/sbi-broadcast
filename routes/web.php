<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecurringScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute Publik ---
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/siaran', [BroadcastController::class, 'index'])->name('siaran.index');
Route::get('/api/schedule', [BroadcastController::class, 'getScheduleApi'])->name('api.broadcast.schedule');


// --- Grup untuk Admin yang Sudah Login & Terverifikasi ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Video
    Route::resource('videos', VideoController::class);

    // Manajemen Jadwal (Sekali Jalan)
    Route::resource('schedules', ScheduleController::class)->except(['show', 'create']);

    // Manajemen Jadwal Berulang
    Route::resource('recurring-schedules', RecurringScheduleController::class)->except(['show', 'create']);

});

require __DIR__.'/auth.php';
