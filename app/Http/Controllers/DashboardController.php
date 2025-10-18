<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Schedule;
use App\Models\RecurringSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now(config('app.timezone'));
        $dayOfWeek = $now->dayOfWeek;
        $currentTime = $now->format('H:i:s');

        // --- 1. Data Statistik Utama ---
        $totalVideos = Video::count();
        
        // Hitung total jadwal aktif dari kedua jenis
        $activeFixedSchedulesCount = Schedule::where('start_time', '<=', $now)
                                            ->where('end_time', '>=', $now)
                                            ->count();
        $activeRecurringSchedulesCount = RecurringSchedule::whereJsonContains('days_of_week', $dayOfWeek)
                                                          ->where('start_time', '<=', $currentTime)
                                                          ->where('end_time', '>=', $currentTime)
                                                          ->count();
        $totalActiveSchedules = $activeFixedSchedulesCount + $activeRecurringSchedulesCount;

        $upcomingSchedulesCount = Schedule::where('start_time', '>', $now)->count();
        $totalSchedules = Schedule::count() + RecurringSchedule::count();
        $recentVideos = Video::latest()->take(3)->get();
        $activeOneTimeSchedules = Schedule::with('video:id,title')
                                          ->where('start_time', '<=', $now)
                                          ->where('end_time', '>=', $now)
                                          ->orderBy('start_time', 'asc')
                                          ->take(3)
                                          ->get();

        // Jadwal tetap yang akan datang
        $upcomingFixedSchedules = Schedule::with('video:id,title')
                                          ->where('start_time', '>', $now)
                                          ->orderBy('start_time', 'asc')
                                          ->take(3)
                                          ->get();

        // Jadwal rutin untuk hari ini
        $todaysRecurringSchedules = RecurringSchedule::with('video:id,title')
                                                    ->whereJsonContains('days_of_week', $dayOfWeek)
                                                    ->orderBy('start_time', 'asc')
                                                    ->get();

        return view('dashboard', [
            // Data untuk kartu statistik
            'totalVideos' => $totalVideos,
            'totalCurrentSchedules' => $totalActiveSchedules,
            'upcomingSchedules' => $upcomingSchedulesCount,
            'allSchedules' => $totalSchedules,
            
            // Data untuk kartu konten
            'recentVideos' => $recentVideos,
            'activeOneTimeSchedules' => $activeOneTimeSchedules, 
            'upcomingOneTimeSchedules' => $upcomingFixedSchedules,
            'todaysRecurringSchedules' => $todaysRecurringSchedules,
        ]);
    }
}
