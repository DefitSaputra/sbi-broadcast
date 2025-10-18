<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecurringScheduleController;
use App\Http\Controllers\RecurringBroadcastController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/siaran', [BroadcastController::class, 'index'])->name('siaran.index');
Route::get('/api/schedule', [BroadcastController::class, 'getScheduleApi'])->name('api.broadcast.schedule');


Route::get('/siaran-berulang', [RecurringBroadcastController::class, 'index'])->name('siaran.recurring.index');
Route::get('/api/recurring-schedule', [RecurringBroadcastController::class, 'getScheduleApi'])->name('api.recurring.schedule');

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('videos', VideoController::class);
    Route::resource('schedules', ScheduleController::class)->except(['show', 'create']);
    Route::resource('recurring-schedules', RecurringScheduleController::class)->except(['show', 'create']);

});

require __DIR__.'/auth.php';
