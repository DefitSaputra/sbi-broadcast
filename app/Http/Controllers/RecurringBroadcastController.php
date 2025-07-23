<?php

namespace App\Http\Controllers;

use App\Models\RecurringSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class RecurringBroadcastController extends Controller
{
    /**
     * Menampilkan halaman siaran utama.
     */
    public function index()
    {
        // PERBAIKAN:
        // Query orderByRaw("FIELD(days_of_week, ...)") tidak akan berfungsi
        // pada kolom JSON. Sebagai gantinya, kita ambil semua jadwal yang
        // diurutkan berdasarkan waktu mulai saja. Logika pengelompokan per hari
        // lebih baik ditangani di frontend (tampilan Blade/Vue/Alpine).
        $allSchedules = RecurringSchedule::with('video')
            ->orderBy('start_time')
            ->get();
            
        return view('siaran.recurring', [
            'allSchedules' => $allSchedules,
            'currentDay' => Carbon::now()->dayOfWeek,
        ]);
    }

    /**
     * Menyediakan API untuk mendapatkan jadwal yang sedang berlangsung dan berikutnya.
     */
    public function getScheduleApi()
    {
        $now = Carbon::now(config('app.timezone'));
        $dayOfWeek = $now->dayOfWeek;
        $currentTime = $now->toTimeString(); // Menggunakan toTimeString() lebih aman

        // 1. Cari jadwal yang aktif sekarang (Query ini sudah bagus)
        $current = RecurringSchedule::with('video')
            ->whereJsonContains('days_of_week', $dayOfWeek)
            ->where('start_time', '<=', $currentTime)
            ->where('end_time', '>=', $currentTime)
            ->orderBy('start_time')
            ->first();

        // 2. Cari jadwal berikutnya
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
        // Pertama, coba cari jadwal berikutnya di hari yang sama. Ini sangat cepat.
        $nextToday = RecurringSchedule::with('video')
            ->whereJsonContains('days_of_week', $currentDayOfWeek)
            ->where('start_time', '>', $currentTime)
            ->orderBy('start_time')
            ->first();

        if ($nextToday) {
            return $nextToday;
        }

        // Jika tidak ada lagi jadwal hari ini, cari di hari-hari berikutnya.
        // Kita ambil semua jadwal sekali saja untuk diolah di PHP, ini jauh
        // lebih cepat daripada 7x query ke database.
        $allSchedules = RecurringSchedule::with('video')
            ->orderBy('start_time')
            ->get();
        
        // Buat urutan hari untuk diperiksa, dimulai dari besok.
        $dayOrder = [];
        for ($i = 1; $i <= 7; $i++) {
            $dayOrder[] = ($currentDayOfWeek + $i) % 7;
        }
        // Contoh jika hari ini Rabu (3), $dayOrder akan menjadi: [4, 5, 6, 0, 1, 2, 3]

        // Lakukan iterasi berdasarkan urutan hari yang sudah dibuat.
        foreach ($dayOrder as $day) {
            foreach ($allSchedules as $schedule) {
                // Cek apakah jadwal ini ada di hari yang sedang diperiksa.
                if (in_array($day, $schedule->days_of_week)) {
                    // Jika ditemukan, ini adalah jadwal berikutnya. Langsung kembalikan.
                    return $schedule;
                }
            }
        }

        return null; // Tidak ada jadwal berikutnya yang ditemukan.
    }
}