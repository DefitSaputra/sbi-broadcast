<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siaran Rutin - Sederhana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body { background-color: #111827; color: white; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="flex items-center justify-center h-screen">

    <div x-data="broadcastSystem()" x-init="init()" class="w-full h-full">

        <div x-show="currentBroadcast" x-cloak class="w-full h-full bg-black">
            <video x-ref="videoPlayer" class="w-full h-full object-contain" autoplay muted loop playsinline></video>
            
            <div x-show="isMuted" @click="unmutePlayer()" class="absolute inset-0 bg-black/70 flex items-center justify-center cursor-pointer">
                <div class="text-center p-8 border-2 border-gray-600 rounded-lg">
                    <p class="text-lg font-semibold" x-text="currentBroadcast?.title"></p>
                    <p class="text-xl font-bold mt-4">KLIK UNTUK MEMUTAR SUARA</p>
                </div>
            </div>
        </div>

        <div x-show="!currentBroadcast" x-cloak class="flex flex-col items-center justify-center h-full p-8">
            <h1 class="text-3xl font-bold mb-4">Saat Ini Tidak Ada Siaran</h1>
            <p class="text-gray-400 mb-8">Jadwal akan diperbarui secara otomatis.</p>
            
            <div x-show="nextBroadcast" class="bg-gray-800 p-4 rounded-lg text-center">
                <p class="text-sm">Berikutnya:</p>
                <p class="text-lg font-bold" x-text="nextBroadcast?.title"></p>
                <p class="text-green-400" x-text="`Mulai dalam ${nextBroadcast?.timeLeft || '...'}`"></p>
            </div>
        </div>

    </div>

<script>
function broadcastSystem() {
    return {
        // DATA UTAMA
        allSchedules: @json($allSchedules), // Data jadwal dari server (Laravel)
        currentBroadcast: null,             // Siaran yang sedang tayang
        nextBroadcast: null,                // Siaran berikutnya
        isMuted: true,                      // Status suara video

        // FUNGSI INISIALISASI
        init() {
            console.log("Sistem Siaran Dimulai.");
            this.updateSchedule(); // Cek jadwal saat pertama kali dimuat
            setInterval(() => this.updateSchedule(), 30000); // Cek jadwal setiap 30 detik
            setInterval(() => this.updateCountdown(), 1000);  // Update countdown setiap detik
        },

        // FUNGSI UTAMA UNTUK MENGUPDATE JADWAL
        async updateSchedule() {
            try {
                // Mengambil data siaran terbaru dari API server
                const response = await axios.get('{{ route('api.recurring-broadcast.current') }}');
                const { current, next } = response.data;
                
                console.log("Jadwal diperbarui:", new Date().toLocaleTimeString());

                // Cek apakah siaran aktif berubah
                if (current && current.id !== this.currentBroadcast?.id) {
                    console.log("Memulai siaran baru:", current.title);
                    this.currentBroadcast = current;
                    // $nextTick memastikan elemen video sudah ada di DOM sebelum diakses
                    this.$nextTick(() => this.playVideo(current.video.url));
                } 
                // Jika siaran sudah selesai
                else if (!current && this.currentBroadcast) {
                    console.log("Siaran selesai.");
                    this.currentBroadcast = null;
                    this.stopVideo();
                }

                // Update info siaran berikutnya
                this.nextBroadcast = next;

            } catch (error) {
                console.error("Gagal mengambil jadwal dari API:", error);
            }
        },

        // FUNGSI UNTUK MEMUTAR VIDEO
        playVideo(videoUrl) {
            const player = this.$refs.videoPlayer;
            if (!player || !videoUrl) return;
            
            player.src = videoUrl;
            player.play().catch(e => console.error("Autoplay gagal:", e));
        },

        // FUNGSI UNTUK MENGHENTIKAN VIDEO
        stopVideo() {
            const player = this.$refs.videoPlayer;
            if (!player) return;

            player.pause();
            player.src = '';
        },
        
        // FUNGSI UNTUK MENYALAKAN SUARA
        unmutePlayer() {
            this.$refs.videoPlayer.muted = false;
            this.isMuted = false;
        },

        // FUNGSI UNTUK MENGHITUNG MUNDUR
        updateCountdown() {
            if (!this.nextBroadcast) return;

            const now = new Date();
            const [hours, minutes] = this.nextBroadcast.start_time.split(':');
            const nextTime = new Date();
            nextTime.setHours(hours, minutes, 0);

            // Jika waktu siaran sudah lewat hari ini, set untuk hari berikutnya
            if (nextTime <= now) {
                nextTime.setDate(nextTime.getDate() + 1);
            }
            
            const diff = nextTime - now;
            const h = Math.floor(diff / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((diff % (1000 * 60)) / 1000);

            this.nextBroadcast.timeLeft = `${h} jam ${m} menit ${s} detik`;
        }
    }
}
</script>

</body>
</html>