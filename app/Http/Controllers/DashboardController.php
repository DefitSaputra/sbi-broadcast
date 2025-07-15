<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data untuk kartu statistik
        $totalVideos = Video::count();

        $now = Carbon::now();
        $activeBroadcasts = Schedule::where('start_time', '<=', $now)
                                    ->where('end_time', '>=', $now)
                                    ->count();
                                    
        $upcomingSchedules = Schedule::where('start_time', '>', $now)
                                     ->count();

        // Mengirim semua data ke view 'dashboard'
        return view('dashboard', [
            'totalVideos' => $totalVideos,
            'activeBroadcasts' => $activeBroadcasts,
            'upcomingSchedules' => $upcomingSchedules,
        ]);
    }
}