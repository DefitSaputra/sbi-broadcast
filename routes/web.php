<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk dashboard yang hanya bisa diakses setelah login dan verifikasi email.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- PENGGABUNGAN ---
// Semua route yang memerlukan autentikasi (login) digabungkan di sini.
Route::middleware('auth')->group(function () {
    
    // Rute untuk manajemen profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk manajemen video (CRUD)
    Route::resource('videos', VideoController::class);

    
});


require __DIR__.'/auth.php';
