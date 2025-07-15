<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\DashboardController; // <-- TAMBAHKAN USE STATEMENT INI
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute
| ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web".
|
*/

Route::get('/', function () {
    // Arahkan halaman utama ke halaman login atau dashboard
    return redirect()->route('login'); 
});

// --- Rute Publik untuk Penonton ---
Route::get('/siaran', [BroadcastController::class, 'index'])->name('siaran.index');

// --- Rute API untuk Halaman Siaran (dipanggil oleh JavaScript) ---
Route::get('/api/schedule', [BroadcastController::class, 'getScheduleApi'])->name('api.schedule');


// --- Grup untuk Admin yang Sudah Login ---
Route::middleware('auth')->group(function () {
    
    // --- PERBAIKAN: Arahkan rute dashboard ke DashboardController ---
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Video menggunakan resource controller
    Route::resource('videos', VideoController::class);

    // Manajemen Jadwal menggunakan resource controller
    // Method show() tidak kita gunakan karena form edit ada di halaman index
    Route::resource('schedules', ScheduleController::class)->except(['show', 'create']);

});


require __DIR__.'/auth.php';
