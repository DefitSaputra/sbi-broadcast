<head>
    <title>Dashboard - Broadcast Management System</title>
</head>

<x-app-layout>
    <title>Dashboard - Broadcast Management System</title>
    <div class="py-6 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="relative bg-white shadow-lg overflow-hidden mb-8" style="clip-path: polygon(0 0, 100% 0, 95% 100%, 0% 100%);">
                <div class="absolute inset-0">
                    <img class="h-full w-full object-cover" src="{{ asset('images/bg-sbi3.jpeg') }}" alt="Background industri">
                    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>
                </div>
                
                <div class="relative px-8 py-16 sm:px-12 sm:py-20 lg:px-16 lg:py-24">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        {{-- Content --}}
                        <div class="text-left">
                            <p class="text-sbi-red font-semibold text-lg mb-4 tracking-wide">
                                Pembangunan Berkelanjutan
                            </p>
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-6">
                                Broadcast<br>
                                <span class="text-sbi-green">Management</span><br>
                                <span class="text-gray-300 text-3xl sm:text-4xl lg:text-5xl">System</span>
                            </h1>
                            <p class="text-gray-200 text-lg leading-relaxed mb-8 max-w-xl">
                                Pembangunan yang berpihak kepada bumi, mendorong kami berinovasi 
                                untuk menyediakan solusi produk dan layanan inovatif dalam 
                                pengelolaan konten video yang berkelanjutan.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('videos.index') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-sbi-green text-black font-bold text-lg hover:bg-opacity-90 transition-colors duration-200 transform hover:scale-105">
                                    <span>Selengkapnya</span>
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-1">
                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-lime-50 transition-all duration-500 shadow-lg hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-lime-100 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-4xl font-black text-gray-900 mb-2">{{ str_pad($totalVideos, 2, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-sm text-gray-600 font-medium">Total Video</div>
                                </div>
                                <div class="p-3 bg-lime-100 rounded-full">
                                    <svg class="w-6 h-6 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 h-1 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-lime-500 rounded-full" style="width: {{ min(100, ($totalVideos / 50) * 100) }}%"></div>
                            </div>
                            <div class="text-lime-600 text-xs font-semibold mt-2">{{ \Carbon\Carbon::now()->format('M \'y') }}</div>
                        </div>
                    </div>

                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-blue-50 transition-all duration-500 shadow-lg hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-100 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-4xl font-black text-gray-900 mb-2">{{ str_pad($totalCurrentSchedules, 2, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-sm text-gray-600 font-medium">Jadwal Aktif</div>
                                </div>
                                <div class="p-3 bg-blue-100 rounded-full">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 h-1 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full" style="width: {{ $totalCurrentSchedules > 0 ? '100%' : '0%' }}"></div>
                            </div>
                            <div class="text-blue-600 text-xs font-semibold mt-2">Saat Ini</div>
                        </div>
                    </div>

                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-purple-50 transition-all duration-500 shadow-lg hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-100 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-4xl font-black text-gray-900 mb-2">{{ str_pad($upcomingSchedules, 2, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-sm text-gray-600 font-medium">Jadwal Mendatang</div>
                                </div>
                                <div class="p-3 bg-purple-100 rounded-full">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 h-1 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full" style="width: {{ min(100, ($upcomingSchedules / 20) * 100) }}%"></div>
                            </div>
                            <div class="text-purple-600 text-xs font-semibold mt-2">{{ \Carbon\Carbon::now()->addMonth()->format('M \'y') }}</div>
                        </div>
                    </div>

                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-amber-50 transition-all duration-500 shadow-lg hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-100 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-4xl font-black text-gray-900 mb-2">{{ str_pad($allSchedules, 2, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-sm text-gray-600 font-medium">Total Jadwal</div>
                                </div>
                                <div class="p-3 bg-amber-100 rounded-full">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 h-1 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 rounded-full" style="width: {{ min(100, ($allSchedules / 30) * 100) }}%"></div>
                            </div>
                            <div class="text-amber-600 text-xs font-semibold mt-2">Total</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <div class="bg-white shadow-lg rounded-xl overflow-hidden relative group hover:shadow-2xl transition-all duration-300 col-span-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-lime-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 h-full flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sbi-red font-semibold text-sm mb-2 uppercase tracking-wider">Manajemen Konten</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">Galeri Video</h3>
                            </div>
                            <div class="p-3 bg-lime-100 rounded-lg group-hover:bg-lime-200 transition-colors">
                                <svg class="w-6 h-6 text-lime-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                            Kelola, edit, dan organisir semua konten video Anda dengan sistem yang terintegrasi dan mudah digunakan.
                        </p>
                        
                        {{-- Recent Videos List --}}
                        <div class="mb-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Video Terbaru</h4>
                            <ul class="space-y-2">
                                @forelse($recentVideos as $video)
                                <li class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-lime-500 rounded-full"></span>
                                    <span class="text-sm truncate">{{ Str::limit($video->title, 30) }}</span>
                                </li>
                                @empty
                                <li class="text-sm text-gray-500">Belum ada video</li>
                                @endforelse
                            </ul>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <a href="{{ route('videos.index') }}" class="inline-flex items-center px-4 py-2 bg-lime-100 text-lime-800 font-bold text-sm hover:bg-lime-200 transition-colors rounded-lg">
                                <span>Kelola Video</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            <span class="text-xs text-gray-500">{{ $totalVideos }} video tersedia</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-xl overflow-hidden relative group hover:shadow-2xl transition-all duration-300 col-span-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 h-full flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sbi-red font-semibold text-sm mb-2 uppercase tracking-wider">Manajemen Siaran</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">Jadwal One-Day</h3>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-lg group-hover:bg-blue-200 transition-colors">
                                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                            Atur jadwal tayang satu kali dengan sistem penjadwalan cerdas untuk memaksimalkan jangkauan audiens.
                        </p>
                        
                        <div class="mb-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Siaran Aktif</h4>
                            <ul class="space-y-2">
                                @forelse($activeOneTimeSchedules as $schedule)
                                <li class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                    <span class="text-sm truncate">
                                        {{ $schedule->video->title ?? 'No Video' }} ({{ $schedule->start_time->format('H:i') }})
                                    </span>
                                </li>
                                @empty
                                <li class="text-sm text-gray-500">Tidak ada siaran aktif</li>
                                @endforelse
                            </ul>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <a href="{{ route('schedules.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 font-bold text-sm hover:bg-blue-200 transition-colors rounded-lg">
                                <span>Kelola Jadwal</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            <span class="text-xs text-gray-500">{{ $totalCurrentSchedules }} aktif / {{ $upcomingSchedules }} mendatang</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-xl overflow-hidden relative group hover:shadow-2xl transition-all duration-300 col-span-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 h-full flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sbi-red font-semibold text-sm mb-2 uppercase tracking-wider">Manajemen Siaran</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">Jadwal Multi-Day</h3>
                            </div>
                            <div class="p-3 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors">
                                <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                            Atur jadwal tayang berulang untuk konten reguler dengan pengaturan yang fleksibel dan mudah dikelola.
                        </p>
                        
                        <div class="mb-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Jadwal Berikutnya</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                    <span class="text-sm">Pagi: 08:00 - 09:00</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                    <span class="text-sm">Siang: 12:00 - 13:00</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                    <span class="text-sm">Malam: 19:00 - 20:00</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <a href="{{ route('recurring-schedules.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-100 text-purple-800 font-bold text-sm hover:bg-purple-200 transition-colors rounded-lg">
                                <span>Kelola Jadwal</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            <span class="text-xs text-gray-500">3 jadwal aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <div class="bg-white shadow-lg rounded-xl overflow-hidden relative group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 h-full flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sbi-red font-semibold text-sm mb-2 uppercase tracking-wider">Pemantauan Siaran</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">Siaran One-Day Schedules</h3>
                            </div>
                            <div class="p-3 bg-amber-100 rounded-lg group-hover:bg-amber-200 transition-colors">
                                <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                            Pantau siaran one-day secara real-time dengan tampilan yang informatif dan interaktif.
                        </p>
                        
                        <div class="mb-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Akan Datang</h4>
                            <ul class="space-y-2">
                                @forelse($upcomingOneTimeSchedules as $schedule)
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                                        <span class="text-sm">{{ $schedule->video->title ?? 'No Video' }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $schedule->start_time->format('d M H:i') }}</span>
                                </li>
                                @empty
                                <li class="text-sm text-gray-500">Tidak ada jadwal mendatang</li>
                                @endforelse
                            </ul>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <a href="{{ route('siaran.index') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-amber-100 text-amber-800 font-bold text-sm hover:bg-amber-200 transition-colors rounded-lg">
                                <span>Lihat Siaran</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                            <span class="text-xs text-gray-500">{{ $upcomingSchedules }} jadwal mendatang</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-lg rounded-xl overflow-hidden relative group hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-50 to-white opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 h-full flex flex-col">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sbi-red font-semibold text-sm mb-2 uppercase tracking-wider">Pemantauan Siaran</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">Siaran Multi-Day Schedules</h3>
                            </div>
                            <div class="p-3 bg-rose-100 rounded-lg group-hover:bg-rose-200 transition-colors">
                                <svg class="w-6 h-6 text-rose-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6 flex-grow">
                            Pantau siaran multi-day dengan jadwal berulang dan dapatkan notifikasi untuk setiap sesi siaran.
                        </p>
                        
                        <div class="mb-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Hari Ini</h4>
                            <ul class="space-y-2">
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-2 h-2 bg-rose-500 rounded-full"></span>
                                        <span class="text-sm">Siaran Pagi</span>
                                    </div>
                                    <span class="text-xs text-gray-500">08:00 - 09:00</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-2 h-2 bg-rose-500 rounded-full"></span>
                                        <span class="text-sm">Siaran Siang</span>
                                    </div>
                                    <span class="text-xs text-gray-500">12:00 - 13:00</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-2 h-2 bg-rose-500 rounded-full"></span>
                                        <span class="text-sm">Siaran Malam</span>
                                    </div>
                                    <span class="text-xs text-gray-500">19:00 - 20:00</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <a href="{{ route('siaran.recurring.index') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-rose-100 text-rose-800 font-bold text-sm hover:bg-rose-200 transition-colors rounded-lg">
                                <span>Lihat Siaran</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                            <span class="text-xs text-gray-500">3 sesi hari ini</span>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>