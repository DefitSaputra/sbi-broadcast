<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siaran Berulang - SBI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        html, body { height: 100%; overflow: hidden; background-color: #111827; color: white; font-family: 'Inter', sans-serif; }
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        [x-cloak] { display: none !important; }
        @keyframes marquee { 0% { transform: translateX(100%); } 100% { transform: translateX(-100%); } }
        .animate-marquee { animation: marquee 25s linear infinite; }
    </style>
</head>
<body class="flex items-center justify-center">

    <div x-data="broadcastManager(@json($allSchedules))" x-init="init()" class="w-full h-full">

        <!-- Tampilan Video Player -->
        <div x-show="currentBroadcast" x-cloak class="w-full h-full bg-black relative">
            <video x-ref="videoPlayer" class="w-full h-full object-contain" autoplay muted playsinline></video>
            
            <!-- Overlay Unmute -->
            <div x-show="isMuted" @click="unmuteAndPlay()" class="absolute inset-0 bg-black bg-opacity-70 flex flex-col items-center justify-center cursor-pointer z-20 transition-opacity duration-300 hover:bg-opacity-60">
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-300" x-text="currentBroadcast?.title"></p>
                    <svg class="w-20 h-20 lg:w-24 lg:h-24 text-white opacity-80 my-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 9.75L19.5 12m0 0l2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z" /></svg>
                    <p class="text-xl font-bold tracking-wide">AKTIFKAN SUARA</p>
                </div>
            </div>

            <!-- Running Text -->
            <div x-show="currentBroadcast && currentBroadcast.running_text" class="absolute bottom-0 left-0 w-full bg-black bg-opacity-75 overflow-hidden z-10">
                <p class="whitespace-nowrap animate-marquee text-2xl lg:text-4xl py-3 font-semibold" x-text="currentBroadcast.running_text"></p>
            </div>
        </div>

        <!-- Tampilan Jadwal Mingguan (Saat Tidak Ada Siaran) -->
        <div x-show="!currentBroadcast" x-cloak class="w-full h-full flex flex-col items-center justify-center p-4 sm:p-8">
            <img src="{{ asset('images/logo-white.svg') }}" alt="Logo" class="h-16 mb-4">
            <h1 class="text-3xl font-black text-white mb-2" x-text="message"></h1>
            <p class="text-gray-400 mb-8">Jadwal siaran rutin mingguan</p>

            <div class="w-full max-w-6xl grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-2 text-center">
                <template x-for="day in days" :key="day.id">
                    <div class="border rounded-lg p-3 transition-all duration-300" :class="day.isToday ? 'border-sbi-green bg-sbi-green/10' : 'border-gray-700 bg-gray-800/50'">
                        <p class="font-bold text-sm uppercase" :class="day.isToday ? 'text-sbi-green' : 'text-white'">
                            <span x-text="day.name"></span>
                        </p>
                        <div class="mt-3 space-y-2 text-left text-xs">
                            <template x-if="getSchedulesForDay(day.id).length === 0">
                                <p class="text-gray-500 text-center italic text-xs py-4">Tidak ada jadwal</p>
                            </template>
                            <template x-for="schedule in getSchedulesForDay(day.id)" :key="schedule.id">
                                <div class="bg-gray-700/50 p-2 rounded">
                                    <p class="font-bold text-gray-200 truncate" x-text="schedule.title"></p>
                                    <p class="text-gray-400" x-text="formatTime(schedule.start_time) + ' - ' + formatTime(schedule.end_time)"></p>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <script>
    function broadcastManager(allSchedules = []) {
        return {
            allSchedules: allSchedules,
            currentBroadcast: null,
            message: 'Memuat Jadwal...',
            isMuted: true,
            days: [
                { id: 1, name: 'Senin', isToday: false }, { id: 2, name: 'Selasa', isToday: false },
                { id: 3, name: 'Rabu', isToday: false }, { id: 4, name: 'Kamis', isToday: false },
                { id: 5, name: 'Jumat', isToday: false }, { id: 6, name: 'Sabtu', isToday: false },
                { id: 0, name: 'Minggu', isToday: false }
            ],
            
            init() {
                // Tandai hari ini di kalender
                const today = new Date().getDay(); // Minggu = 0, Senin = 1, ...
                const dayIndex = this.days.findIndex(d => d.id === today);
                if(dayIndex > -1) this.days[dayIndex].isToday = true;

                this.fetchSchedule();
                setInterval(() => this.fetchSchedule(), 15000);
            },

            fetchSchedule() {
                axios.get('{{ route("api.recurring.schedule") }}')
                    .then(response => {
                        const newBroadcast = response.data.current;
                        const oldBroadcastId = this.currentBroadcast ? this.currentBroadcast.id : null;
                        const newBroadcastId = newBroadcast ? newBroadcast.id : null;

                        if (newBroadcastId !== oldBroadcastId) {
                            this.currentBroadcast = newBroadcast;
                            this.$nextTick(() => {
                                if (this.currentBroadcast) this.handleNewVideo();
                            });
                        }
                        
                        if (!this.currentBroadcast) this.message = 'Saat Ini Tidak Ada Siaran';
                    })
                    .catch(error => {
                        console.error("Gagal mengambil jadwal:", error);
                        this.message = 'Gagal Memuat Jadwal';
                    });
            },

            handleNewVideo() {
                const video = this.$refs.videoPlayer;
                if (!video) return;
                video.src = this.currentBroadcast.video.url;
                video.load();
                const onCanPlay = () => {
                    video.muted = this.isMuted;
                    video.controls = !this.isMuted;
                    video.play().catch(e => console.log('Autoplay dicegah'));
                };
                video.removeEventListener('canplay', onCanPlay);
                video.addEventListener('canplay', onCanPlay, { once: true });
            },

            unmuteAndPlay() {
                const video = this.$refs.videoPlayer;
                if (!video) return;
                this.isMuted = false;
                video.muted = false;
                video.controls = true;
                video.play().catch(e => console.error("Gagal play setelah unmute:", e));
            },

            getSchedulesForDay(dayId) {
                return this.allSchedules.filter(schedule => schedule.days_of_week.includes(dayId));
            },

            formatTime(timeString) {
                return timeString.substring(0, 5); // Mengambil HH:MM dari HH:MM:SS
            }
        }
    }
    </script>
</body>
</html>
