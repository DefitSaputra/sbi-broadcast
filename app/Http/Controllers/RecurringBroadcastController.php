<?php

namespace App\Http\Controllers;

use App\Models\RecurringSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecurringBroadcastController extends Controller
{
    /**
     * Menampilkan halaman siaran utama untuk jadwal berulang.
     */
    public function index()
    {
        // PERUBAHAN: Ambil semua jadwal untuk ditampilkan di kalender mingguan
        $allSchedules = RecurringSchedule::with('video:id,title')->get();
        
        return view('siaran.recurring', ['allSchedules' => $allSchedules]);
    }

    /**
     * Menyediakan data jadwal berulang untuk API.
     */
    public function getScheduleApi()
    {
        $now = Carbon::now();
        $dayOfWeek = $now->dayOfWeek; // 0=Minggu, 1=Senin, ..., 6=Sabtu
        $currentTime = $now->format('H:i:s');

        // Cari jadwal berulang yang aktif saat ini
        $current = RecurringSchedule::with('video')
            ->whereJsonContains('days_of_week', $dayOfWeek)
            ->where('start_time', '<=', $currentTime)
            ->where('end_time', '>=', $currentTime)
            ->latest()
            ->first();

        $next = null; // Konsep "next" tidak digunakan di siaran berulang

        return response()->json([
            'current' => $current,
            'next' => $next,
            'server_time' => $now->toIso8601String(),
        ]);
    }
}
