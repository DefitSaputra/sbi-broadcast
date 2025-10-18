<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siaran Langsung One-Day</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        html, body { height: 100%; overflow: hidden; background-color: #000; color: white; font-family: 'Inter', sans-serif; }
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
        [x-cloak] { display: none !important; }
        @keyframes marquee { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
        .animate-marquee { animation: marquee 20s linear infinite; }
    </style>
</head>
<body class="flex items-center justify-center">

    <div 
        x-data="broadcastManager()" 
        x-init="init()" 
        class="w-full h-full flex flex-col items-center justify-center"
    >
        <template x-if="currentBroadcast">
            <div class="w-full h-full bg-black relative">
                <video x-ref="videoPlayer" class="w-full h-full object-contain" autoplay muted loop controls playsinline></video>
                
                <div x-show="isMuted" @click="unmutePlayer()" class="absolute inset-0 bg-black/70 flex items-center justify-center cursor-pointer z-10">
                    <div class="text-center p-8 border-2 border-gray-600 rounded-lg">
                        <p class="text-lg font-semibold" x-text="currentBroadcast?.title"></p>
                        <p class="text-xl font-bold mt-4">KLIK UNTUK MEMUTAR SUARA</p>
                    </div>
                </div>

                <div x-show="currentBroadcast.running_text" class="absolute bottom-0 left-0 w-full bg-black bg-opacity-70 overflow-hidden">
                    <p class="whitespace-nowrap animate-marquee text-xl lg:text-3xl py-2" x-text="currentBroadcast.running_text"></p>
                </div>
            </div>
        </template>

        <template x-if="!currentBroadcast">
            <div class="text-center transition-opacity duration-500">
                <img src="{{ asset('images/mini-logo.png') }}" alt="Logo" class="h-36 block mx-auto mb-4 opacity-50">
                <h1 class="text-3xl font-bold" x-text="message"></h1>
                <template x-if="nextBroadcast">
                    <p class="text-gray-400 mt-2">
                        Siaran selanjutnya <span x-text="nextBroadcast.title"></span> akan dimulai <span x-text="timeUntilNext"></span>.
                    </p>
                </template>
                <template x-if="!nextBroadcast">
                    <p class="text-gray-400 mt-2">
                        Saat Ini Tidak Ada Siaran.
                    </p>
                </template>
            </div>
        </template>
    </div>

<script>

function broadcastManager() {
    return {
        currentBroadcast: null,
        nextBroadcast: null,
        message: 'Memuat Jadwal...',
        timeUntilNext: '',
        isMuted: true,
        userInteracted: false,
        
        init() {
            document.addEventListener('click', () => {
                if (!this.userInteracted) {
                    this.userInteracted = true;
                    this.unmutePlayer();
                }
            }, { once: true });
            
            this.fetchSchedule();
            setInterval(() => this.fetchSchedule(), 5000);
            setInterval(() => this.updateCountdown(), 1000);
        },

        async fetchSchedule() {
            try {
                const response = await axios.get('{{ route("api.broadcast.schedule") }}');
                const { current, next } = response.data;
                const newBroadcastId = current ? current.id : null;
                const oldBroadcastId = this.currentBroadcast ? this.currentBroadcast.id : null;

                this.nextBroadcast = next;

                if (newBroadcastId !== oldBroadcastId) {
                    if (current) {
                        this.currentBroadcast = current;
                        this.$nextTick(() => this.playVideo(current.video.url));
                    } else {
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

        playVideo(videoUrl) {
            const player = this.$refs.videoPlayer;
            if (!player || !videoUrl) return;
            player.src = videoUrl; 
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
                player.pause();
                player.removeAttribute("src");
                player.load();
            }
        },
        
        unmutePlayer() {
            this.userInteracted = true;
            const player = this.$refs.videoPlayer;
            if (player && this.currentBroadcast) {
                player.muted = false;
                this.isMuted = false;
            }
        },

        updateCountdown() {
            if (!this.nextBroadcast) {
                this.timeUntilNext = '';
                return;
            }
            const now = new Date();
            const next = new Date(this.nextBroadcast.start_time);
            const diff = next - now;

            if (diff <= 0) {
                this.timeUntilNext = 'sebentar lagi';
                return;
            }
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            let parts = [];
            if (hours > 0) parts.push(`${hours} jam`);
            if (minutes > 0) parts.push(`${minutes} menit`);
            if (hours === 0) parts.push(`${seconds} detik`);
            
            this.timeUntilNext = 'dalam ' + parts.join(' ');
        }
    }
}
</script>

</body>
</html>