<?php
    namespace App\Http\Controllers;

    use App\Models\Schedule;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    class BroadcastController extends Controller
    {
        /**
         * Menampilkan halaman siaran utama.
         */
        public function index()
        {
            $now = Carbon::now();

            $currentBroadcast = Schedule::with('video')
                ->where('start_time', '<=', $now)
                ->where('end_time', '>=', $now)
                // URUTKAN berdasarkan waktu mulai terbaru sebelum mengambil satu
                ->orderBy('start_time', 'desc') // <-- TAMBAHKAN BARIS INI
                ->first();

            return view('siaran.index', [
                'broadcast' => $currentBroadcast
            ]);
        }

    /**
     * Menyediakan data jadwal untuk API.
     * Inilah yang akan dipanggil oleh JavaScript.
     */
    public function getScheduleApi()
    {
        $now = Carbon::now();

        // 1. Cari jadwal yang SEDANG TAYANG saat ini
        $current = Schedule::with('video')
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->orderBy('start_time', 'desc')
            ->first();

        // 2. Cari jadwal BERIKUTNYA yang akan tayang
        // (yang waktu mulainya paling dekat di masa depan)
        $next = Schedule::with('video')
            ->where('start_time', '>', $now)
            ->orderBy('start_time', 'asc')
            ->first();

        // 3. Kembalikan data dalam format JSON
        return response()->json([
            'current' => $current,
            'next' => $next,
            'server_time' => $now->toIso8601String(),
        ]);
    }
    }
    