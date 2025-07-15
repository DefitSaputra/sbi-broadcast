<head>
    <title>Dashboard - Broadcast Management System</title>
</head>

<x-app-layout>
    <title>Dashboard - Broadcast Management System</title>
    {{-- Mengganti <br> dengan padding yang lebih konsisten --}}
    <div class="py-6 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Hero Section (Tetap sama, sesuai permintaan) --}}
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

            {{-- Stats Section (Dibuat Dinamis) --}}
            <div class="mb-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-1">
                    {{-- Stat Card 1: Total Video --}}
                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-lime-50 transition-colors duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-lime-500 transform rotate-45 translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform duration-300"></div>
                        <div class="relative z-10">
                            <div class="text-4xl font-black text-gray-900 mb-2">{{ str_pad($totalVideos, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-sm text-gray-600 font-medium">Total Video</div>
                            <div class="text-lime-600 text-xs font-semibold mt-1">{{ \Carbon\Carbon::now()->format('M \'y') }}</div>
                        </div>
                    </div>

                    {{-- Stat Card 2: Siaran Aktif --}}
                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-red-50 transition-colors duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-red-500 transform rotate-45 translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform duration-300"></div>
                        <div class="relative z-10">
                            <div class="text-4xl font-black text-gray-900 mb-2">{{ str_pad($activeBroadcasts, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-sm text-gray-600 font-medium">Siaran Aktif</div>
                            <div class="text-red-600 text-xs font-semibold mt-1">Saat Ini</div>
                        </div>
                    </div>

                    {{-- Stat Card 3: Jadwal Mendatang --}}
                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-lime-50 transition-colors duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-lime-500 transform rotate-45 translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform duration-300"></div>
                        <div class="relative z-10">
                            <div class="text-4xl font-black text-gray-900 mb-2">{{ str_pad($upcomingSchedules, 2, '0', STR_PAD_LEFT) }}</div>
                            <div class="text-sm text-gray-600 font-medium">Jadwal Mendatang</div>
                            <div class="text-lime-600 text-xs font-semibold mt-1">{{ \Carbon\Carbon::now()->format('M \'y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content Section (Disederhanakan & Dinamis) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                {{-- Video Management Card --}}
                <div class="bg-white shadow-lg overflow-hidden relative">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/bg-sbi1.png') }}" alt="Background" class="w-full h-full object-cover opacity-10">
                    </div>
                    <div class="relative p-8">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sbi-red font-semibold text-sm mb-2">Manajemen Konten</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">Galeri Video</h3>
                            </div>
                            <div class="p-3 bg-sbi-green rounded-lg">
                                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">Kelola, edit, dan organisir semua konten video Anda dengan sistem yang terintegrasi dan mudah digunakan.</p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('videos.index') }}" class="inline-flex items-center px-6 py-3 bg-sbi-green text-black font-bold text-sm hover:bg-opacity-90 transition-colors">
                                <span>Kelola Video</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                            <span class="text-xs text-gray-500">{{ $totalVideos }} video tersedia</span>
                        </div>
                    </div>
                </div>

                {{-- Schedule Management Card --}}
                <div class="bg-white shadow-lg overflow-hidden relative">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/bg-sbi7.webp') }}" alt="Background" class="w-full h-full object-cover opacity-10">
                    </div>
                    <div class="relative p-8">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-sbi-red font-semibold text-sm mb-2">Manajemen Siaran</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">Penjadwalan Siaran</h3>
                            </div>
                            <div class="p-3 bg-sbi-red rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">Atur jadwal tayang yang optimal dengan sistem penjadwalan cerdas untuk memaksimalkan jangkauan audiens.</p>
                        <div class="flex items-center justify-between">
                            {{-- Rute ini diperbaiki dari schedules.create ke schedules.index karena form ada di halaman index --}}
                            <a href="{{ route('schedules.index') }}" class="inline-flex items-center px-6 py-3 bg-sbi-red text-white font-bold text-sm hover:bg-opacity-90 transition-colors">
                                <span>Buat Jadwal</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                            <span class="text-xs text-gray-500">{{ $upcomingSchedules }} jadwal mendatang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>