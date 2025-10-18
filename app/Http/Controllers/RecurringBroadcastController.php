<?php

namespace App\Http\Controllers;

use App\Models\RecurringSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class RecurringBroadcastController extends Controller
{
    public function index()
    {
        $allSchedules = RecurringSchedule::with('video')
            ->orderBy('start_time')
            ->get();
            
        return view('siaran.recurring', [
            'allSchedules' => $allSchedules,
            'currentDay' => Carbon::now()->dayOfWeek,
        ]);
    }

    public function getScheduleApi()
    {
        $now = Carbon::now(config('app.timezone'));
        $dayOfWeek = $now->dayOfWeek;
        $currentTime = $now->toTimeString();
        $current = RecurringSchedule::with('video')
            ->whereJsonContains('days_of_week', $dayOfWeek)
            ->where('start_time', '<=', $currentTime)
            ->where('end_time', '>=', $currentTime)
            ->orderBy('start_time')
            ->first();

        $next = $this->findNextBroadcast($dayOfWeek, $currentTime);

        return response()->json([
            'current' => $current,
            'next' => $next,
            'server_time' => $now->toIso8601String(),
            'debug_info' => [
                'day_of_week' => $dayOfWeek,
                'current_time' => $currentTime,
                'timezone' => config('app.timezone')
            ]
        ]);
    }

    /**
     * OPTIMISASI:
     * Fungsi terpisah untuk menemukan jadwal berikutnya dengan lebih efisien.
     * Mencegah "N+1 query problem" dimana ada perulangan query ke database.
     *
     * @param int $currentDayOfWeek
     * @param string $currentTime
     * @return RecurringSchedule|null
     */
    private function findNextBroadcast(int $currentDayOfWeek, string $currentTime): ?RecurringSchedule
    {
        $nextToday = RecurringSchedule::with('video')
            ->whereJsonContains('days_of_week', $currentDayOfWeek)
            ->where('start_time', '>', $currentTime)
            ->orderBy('start_time')
            ->first();

        if ($nextToday) {
            return $nextToday;
        }

        $allSchedules = RecurringSchedule::with('video')
            ->orderBy('start_time')
            ->get();
        
        $dayOrder = [];
        for ($i = 1; $i <= 7; $i++) {
            $dayOrder[] = ($currentDayOfWeek + $i) % 7;
        }

        foreach ($dayOrder as $day) {
            foreach ($allSchedules as $schedule) {
                if (in_array($day, $schedule->days_of_week)) {
                    return $schedule;
                }
            }
        }

        return null;
    }
}