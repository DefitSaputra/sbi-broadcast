<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BroadcastController;
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
    // Arahkan halaman utama ke halaman siaran jika diinginkan, atau ke login
    return redirect()->route('siaran.index'); 
});

// --- Rute Publik untuk Penonton ---
Route::get('/siaran', [BroadcastController::class, 'index'])->name('siaran.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- Grup untuk Admin yang Sudah Login ---
Route::middleware('auth')->group(function () {
    
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manajemen Video menggunakan resource controller
    Route::resource('videos', VideoController::class);

    // --- Manajemen Jadwal ---
    // Rute lama dihapus dan diganti dengan satu baris ini
    // untuk menangani SEMUA aksi CRUD (index, store, edit, update, destroy).
    Route::resource('schedules', ScheduleController::class)->except(['show']); // Method show() tidak kita gunakan

});


require __DIR__.'/auth.php';