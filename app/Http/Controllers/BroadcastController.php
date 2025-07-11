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
    }
    