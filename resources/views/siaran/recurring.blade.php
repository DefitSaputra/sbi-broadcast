<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siaran Rutin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        body { background-color: #111827; color: white; font-family: 'Inter', sans-serif; }
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        [x-cloak] { display: none !important; }
        @keyframes marquee { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
        .animate-marquee { animation: marquee 20s linear infinite; }
    </style>
</head>
<body class="flex items-center justify-center h-screen">

    <div x-data="broadcastSystem()" x-init="init()" class="w-full h-full">

        <div x-show="currentBroadcast" x-cloak class="w-full h-full bg-black relative">
            <video x-ref="videoPlayer" class="w-full h-full object-contain" autoplay muted loop controls playsinline></video>
            
            <div x-show="isMuted && userInteracted" @click="unmutePlayer()" class="absolute inset-0 bg-black/70 flex items-center justify-center cursor-pointer z-10">
                <div class="text-center p-8 border-2 border-gray-600 rounded-lg">
                    <p class="text-lg font-semibold" x-text="currentBroadcast?.title"></p>
                    <p class="text-xl font-bold mt-4">KLIK UNTUK MEMUTAR SUARA</p>
                </div>
            </div>
            <div x-show="currentBroadcast?.running_text" class="absolute bottom-0 left-0 w-full bg-black bg-opacity-70 overflow-hidden">
                <p class="whitespace-nowrap animate-marquee text-xl lg:text-3xl py-2" x-text="currentBroadcast.running_text"></p>
            </div>
        </div>

        <div x-show="!currentBroadcast" x-cloak class="flex flex-col items-center justify-center h-full p-8 text-center">
            <h1 class="text-3xl font-bold mb-4" x-text="message"></h1>
            <p class="text-gray-400 mb-8">Jadwal akan diperbarui secara otomatis.</p>
            <div x-show="nextBroadcast" class="bg-gray-800 p-4 rounded-lg">
                <p class="text-sm">Berikutnya:</p>
                <p class="text-lg font-bold" x-text="nextBroadcast?.title"></p>
                <p class="text-green-400" x-text="`Mulai dalam ${timeLeft}`"></p>
            </div>
        </div>
    </div>

<script>
function broadcastSystem() {
    return {
        currentBroadcast: null,
        nextBroadcast: null,
        isMuted: true,
        userInteracted: false,
        message: 'Memuat Jadwal...',
        timeLeft: '...',

        init() {
            document.addEventListener('click', () => {
                if (!this.userInteracted) {
                    this.userInteracted = true;
                    this.unmutePlayer();
                }
            }, { once: true });

            this.updateSchedule();
            setInterval(() => this.updateSchedule(), 5000); // Interval dipercepat untuk pengujian
            setInterval(() => this.updateCountdown(), 1000);
        },

        async updateSchedule() {
            try {
                const response = await axios.get('{{ route('api.recurring-broadcast.current') }}');
                const { current, next } = response.data;

                const newBroadcastId = current ? current.id : null;
                const oldBroadcastId = this.currentBroadcast ? this.currentBroadcast.id : null;
                
                this.nextBroadcast = next;

                if (newBroadcastId !== oldBroadcastId) {
                    if (current) {
                        // Jika ada siaran baru, putar videonya
                        this.currentBroadcast = current;
                        this.$nextTick(() => this.playVideo(current.video.url));
                    } else {
                        // ### BAGIAN INI ADALAH PERBAIKANNYA ###
                        // Jika tidak ada siaran baru, berarti siaran lama sudah selesai.
                        // Kita harus menghentikan videonya secara manual SEBELUM menyembunyikannya.
                        this.stopVideo();
                        this.currentBroadcast = null;
                    }
                }
                
                if (!this.currentBroadcast) this.message = 'Saat Ini Tidak Ada Siaran';

            } catch (error) {
                console.error("Gagal mengambil jadwal:", error);
                this.message = 'Gagal Memuat Jadwal';
            }
        },

        // --- FUNGSI BARU UNTUK MEMUTAR DAN MENGHENTIKAN VIDEO ---

        playVideo(videoUrl) {
            const player = this.$refs.videoPlayer;
            if (!player || !videoUrl) return;

            console.log("Memuat siaran baru:", videoUrl);
            player.src = videoUrl; // Set sumber video
            
            const startPlayback = () => {
                player.muted = !this.userInteracted;
                this.isMuted = player.muted;
                player.play().catch(error => console.error("Autoplay gagal:", error));
            };
            
            player.removeEventListener('canplay', startPlayback);
            player.addEventListener('canplay', startPlayback, { once: true });
            player.load();
        },

        stopVideo() {
            const player = this.$refs.videoPlayer;
            if (player) {
                console.log("Menghentikan pemutaran video.");
                player.pause(); // Jeda video
                player.removeAttribute("src"); // Hapus sumber video
                player.load(); // Perintahkan elemen untuk memuat ulang tanpa sumber (menghentikan buffering)
            }
        },
        
        // --- FUNGSI LAINNYA ---
        unmutePlayer() {
            if (this.$refs.videoPlayer && this.currentBroadcast) {
                this.$refs.videoPlayer.muted = true;
                this.isMuted = true;
            }
        },
        
        updateCountdown() {
            if (!this.nextBroadcast || !this.nextBroadcast.days_of_week) {
                this.timeLeft = '...';
                return;
            }

            const now = new Date();
            const currentTimeString = now.toTimeString().split(' ')[0];
            const currentDay = now.getDay();
            let smallestDiff = Infinity;
            let nextDate = null;

            this.nextBroadcast.days_of_week.forEach(day => {
                const scheduledDay = parseInt(day);
                let dayDifference = (scheduledDay - currentDay + 7) % 7;
                if (dayDifference === 0 && currentTimeString > this.nextBroadcast.start_time) {
                    dayDifference = 7;
                }
                const tempDate = new Date(now);
                tempDate.setDate(now.getDate() + dayDifference);
                const [h, m, s] = this.nextBroadcast.start_time.split(':');
                tempDate.setHours(h, m, s, 0);
                const diff = tempDate - now;
                if (diff > 0 && diff < smallestDiff) {
                    smallestDiff = diff;
                    nextDate = tempDate;
                }
            });

            if (!nextDate) {
                this.timeLeft = 'segera';
                return;
            }
            const diff = nextDate - now;
            const h = Math.floor(diff / (1000 * 60 * 60));
            const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const s = Math.floor((diff % (1000 * 60)) / 1000);
            this.timeLeft = `${h} jam ${m} menit ${s} detik`;
        }
    }
}
</script>

</body>
</html>