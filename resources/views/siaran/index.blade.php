<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siaran Langsung</title>
    {{-- Menggunakan Tailwind CSS dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Mengimpor Alpine.js (untuk interaktivitas) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- Mengimpor Axios (untuk memanggil API) --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        html, body {
            height: 100%;
            overflow: hidden;
            background-color: #000;
            color: white;
            font-family: 'Inter', sans-serif;
        }
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    </style>
</head>
<body class="flex items-center justify-center">

    {{-- Komponen Alpine.js yang mengelola seluruh halaman --}}
    <div 
        x-data="broadcastManager()" 
        x-init="init()" 
        class="w-full h-full flex flex-col items-center justify-center"
    >
        {{-- Tampilan Video Player (muncul jika ada siaran) --}}
        <template x-if="currentBroadcast">
            <div class="w-full h-full bg-black relative">
                <video x-ref="videoPlayer" class="w-full h-full object-contain" autoplay muted controls playsinline>
                    <source :src="currentBroadcast.video.url" type="video/mp4">
                </video>
                <div x-show="currentBroadcast.running_text" class="absolute bottom-0 left-0 w-full bg-black bg-opacity-70 overflow-hidden">
                    <p class="whitespace-nowrap animate-marquee text-xl lg:text-3xl py-2" x-text="currentBroadcast.running_text"></p>
                </div>
            </div>
        </template>

                {{-- Tampilan "Tidak Ada Siaran" (muncul jika tidak ada siaran) --}}
            <template x-if="!currentBroadcast">
            <div class="text-center transition-opacity duration-500">
                <img src="{{ asset('images/logo-sbi.png') }}" alt="Logo" class="h-16 block mx-auto mb-4 opacity-50">
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

        <style>
            @keyframes marquee {
                0% { transform: translateX(100%); }
                100% { transform: translateX(-100%); }
            }
            .animate-marquee {
                animation: marquee 20s linear infinite;
            }
        </style>
    </div>

    <script>
    function broadcastManager() {
        return {
            currentBroadcast: null,
            nextBroadcast: null,
            message: 'Memuat Jadwal...',
            timeUntilNext: '',
            
            init() {
                this.fetchSchedule();
                setInterval(() => this.fetchSchedule(), 15000);
                setInterval(() => this.updateCountdown(), 1000);
            },

            fetchSchedule() {
                axios.get('{{ route("api.broadcast.schedule") }}')
                    .then(response => {
                        const newBroadcastId = response.data.current ? response.data.current.id : null;
                        const oldBroadcastId = this.currentBroadcast ? this.currentBroadcast.id : null;

                        if (newBroadcastId !== oldBroadcastId) {
                            this.currentBroadcast = response.data.current;
                            
                            // =================================================================
                            // AWAL DARI BLOK PERBAIKAN UTAMA
                            // =================================================================
                            this.$nextTick(() => {
                                if (this.currentBroadcast && this.$refs.videoPlayer) {
                                    const videoPlayer = this.$refs.videoPlayer;

                                    // 1. Definisikan fungsi untuk memulai pemutaran
                                    const startPlayback = () => {
                                        videoPlayer.muted = true; // Pastikan tetap muted
                                        const playPromise = videoPlayer.play();

                                        if (playPromise !== undefined) {
                                            playPromise.catch(error => {
                                                console.error("Autoplay digagalkan oleh browser:", error);
                                            });
                                        }
                                    };
                                    
                                    // 2. Hapus listener lama untuk mencegah duplikasi jika ada
                                    videoPlayer.removeEventListener('canplay', startPlayback);
                                    
                                    // 3. Tambahkan "pendengar acara" baru. Fungsi startPlayback
                                    //    HANYA akan dijalankan setelah browser memberi sinyal 'canplay'
                                    videoPlayer.addEventListener('canplay', startPlayback, { once: true });

                                    // 4. Muat sumber video baru. Ini akan memicu event 'canplay' saat siap.
                                    videoPlayer.load();
                                }
                            });
                            // =================================================================
                            // AKHIR DARI BLOK PERBAIKAN UTAMA
                            // =================================================================
                        }
                        
                        this.nextBroadcast = response.data.next;
                        if (!this.currentBroadcast) {
                            this.message = 'Saat Ini Tidak Ada Siaran';
                        }
                    })
                    .catch(error => {
                        console.error("Gagal mengambil jadwal:", error);
                        this.message = 'Gagal Memuat Jadwal';
                    });
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
                if (hours === 0 && minutes < 5) parts.push(`${seconds} detik`);
                this.timeUntilNext = 'dalam ' + parts.join(' ');
            }
        }
    }
</script>

</body>
</html>