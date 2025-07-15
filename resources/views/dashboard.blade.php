<x-app-layout>
    <br>
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Hero Section dengan style SBI --}}
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
                            <p class="text-red-500 font-semibold text-lg mb-4 tracking-wide">
                                Pembangunan Berkelanjutan
                            </p>
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-6">
                                Broadcast<br>
                                <span class="text-lime-400">Management</span><br>
                                <span class="text-gray-300 text-3xl sm:text-4xl lg:text-5xl">System</span>
                            </h1>
                            <p class="text-gray-200 text-lg leading-relaxed mb-8 max-w-xl">
                                Pembangunan yang berpihak kepada bumi, mendorong kami berinovasi 
                                untuk menyediakan solusi produk dan layanan inovatif dalam 
                                pengelolaan konten video yang berkelanjutan.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('videos.index') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-lime-500 text-black font-bold text-lg hover:bg-lime-400 transition-colors duration-200 transform hover:scale-105">
                                    <span>Selengkapnya</span>
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        {{-- Video/Image Section --}}
                        <div class="relative">
                            <div class="relative bg-white/10 backdrop-blur-sm rounded-lg overflow-hidden shadow-xl">
                                <img src="{{ asset('images/bg-sbi4.webp') }}" 
                                     alt="Video preview" 
                                     class="w-full h-64 sm:h-80 object-cover">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <button class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                                        <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Section dengan style SBI --}}
            <div class="mb-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-1">
                    {{-- Stat Card 1 --}}
                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-lime-50 transition-colors duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-lime-500 transform rotate-45 translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform duration-300"></div>
                        <div class="relative z-10">
                            <div class="text-4xl font-black text-gray-900 mb-2">24</div>
                            <div class="text-sm text-gray-600 font-medium">Total Video</div>
                            <div class="text-lime-600 text-xs font-semibold mt-1">Jul '25</div>
                        </div>
                    </div>

                    {{-- Stat Card 2 --}}
                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-red-50 transition-colors duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-red-500 transform rotate-45 translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform duration-300"></div>
                        <div class="relative z-10">
                            <div class="text-4xl font-black text-gray-900 mb-2">08</div>
                            <div class="text-sm text-gray-600 font-medium">Siaran Aktif</div>
                            <div class="text-red-600 text-xs font-semibold mt-1">Jul '25</div>
                        </div>
                    </div>

                    {{-- Stat Card 3 --}}
                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-lime-50 transition-colors duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-lime-500 transform rotate-45 translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform duration-300"></div>
                        <div class="relative z-10">
                            <div class="text-4xl font-black text-gray-900 mb-2">12</div>
                            <div class="text-sm text-gray-600 font-medium">Jadwal Mendatang</div>
                            <div class="text-lime-600 text-xs font-semibold mt-1">Jul '25</div>
                        </div>
                    </div>

                    {{-- Stat Card 4 --}}
                    <div class="bg-white p-8 relative overflow-hidden group hover:bg-red-50 transition-colors duration-300">
                        <div class="absolute top-0 right-0 w-20 h-20 bg-red-500 transform rotate-45 translate-x-10 -translate-y-10 group-hover:scale-150 transition-transform duration-300"></div>
                        <div class="relative z-10">
                            <div class="text-4xl font-black text-gray-900 mb-2">05</div>
                            <div class="text-sm text-gray-600 font-medium">Video Trending</div>
                            <div class="text-red-600 text-xs font-semibold mt-1">Jul '25</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                
                {{-- Video Management Card --}}
                <div class="bg-white shadow-lg overflow-hidden relative">
                    <div class="absolute inset-0">
                        <img src="{{ asset('images/bg-sbi1.png') }}" alt="Background" class="w-full h-full object-cover opacity-10">
                    </div>
                    <div class="relative p-8">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <p class="text-red-500 font-semibold text-sm mb-2">Siaran Pers</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">
                                    Galeri Video Management System
                                </h3>
                            </div>
                            <div class="p-3 bg-lime-500 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Kelola, edit, dan organisir semua konten video Anda dengan sistem yang terintegrasi dan mudah digunakan untuk efisiensi maksimal.
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('videos.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-lime-500 text-black font-bold text-sm hover:bg-lime-400 transition-colors">
                                <span>Kelola Video</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            <span class="text-xs text-gray-500">24 video tersedia</span>
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
                                <p class="text-red-500 font-semibold text-sm mb-2">Siaran Pers</p>
                                <h3 class="text-2xl font-black text-gray-900 leading-tight">
                                    Penjadwalan Siaran Terintegrasi
                                </h3>
                            </div>
                            <div class="p-3 bg-red-500 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            Atur jadwal tayang yang optimal dengan sistem penjadwalan cerdas untuk memaksimalkan reach dan engagement audience Anda.
                        </p>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('schedules.create') }}" 
                               class="inline-flex items-center px-6 py-3 bg-red-500 text-white font-bold text-sm hover:bg-red-400 transition-colors">
                                <span>Buat Jadwal</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            <span class="text-xs text-gray-500">12 jadwal aktif</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- News/Updates Section dengan style SBI --}}
            <div class="bg-white shadow-lg mb-12">
                <div class="px-8 py-6 border-b border-gray-200">
                    <h3 class="text-2xl font-black text-gray-900">Update Terbaru</h3>
                    <p class="text-gray-600 text-sm mt-1">Berita dan informasi terkini seputar sistem</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0">
                    {{-- News Item 1 --}}
                    <div class="relative group overflow-hidden">
                        <img src="{{ asset('images/bg-sbi3.jpeg') }}" alt="News" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <div class="bg-lime-500 text-black px-3 py-1 text-xs font-bold mb-2 inline-block">
                                15 Jul '25
                            </div>
                            <h4 class="text-white font-bold text-sm leading-tight">
                                Update Sistem Broadcast Management v2.0
                            </h4>
                        </div>
                    </div>

                    {{-- News Item 2 --}}
                    <div class="relative group overflow-hidden">
                        <img src="{{ asset('images/bg-sbi4.webp') }}" alt="News" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <div class="bg-red-500 text-white px-3 py-1 text-xs font-bold mb-2 inline-block">
                                14 Jul '25
                            </div>
                            <h4 class="text-white font-bold text-sm leading-tight">
                                Fitur AI Analytics untuk Video Content
                            </h4>
                        </div>
                    </div>

                    {{-- News Item 3 --}}
                    <div class="relative group overflow-hidden">
                        <img src="{{ asset('images/bg-sbi1.png') }}" alt="News" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <div class="bg-lime-500 text-black px-3 py-1 text-xs font-bold mb-2 inline-block">
                                13 Jul '25
                            </div>
                            <h4 class="text-white font-bold text-sm leading-tight">
                                Integrasi dengan Platform Streaming
                            </h4>
                        </div>
                    </div>

                    {{-- News Item 4 --}}
                    <div class="relative group overflow-hidden">
                        <img src="{{ asset('images/bg-sbi7.webp') }}" alt="News" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-4">
                            <div class="bg-red-500 text-white px-3 py-1 text-xs font-bold mb-2 inline-block">
                                12 Jul '25
                            </div>
                            <h4 class="text-white font-bold text-sm leading-tight">
                                Peningkatan Performa Server 50%
                            </h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions dengan style SBI --}}
            <div class="bg-white shadow-lg p-8 mb-8">
                <h3 class="text-2xl font-black text-gray-900 mb-6">Aksi Cepat</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="#" class="group flex items-center p-4 border border-gray-200 hover:border-lime-500 hover:bg-lime-50 transition-all duration-200">
                        <div class="p-3 bg-lime-500 group-hover:bg-lime-600 transition-colors rounded-lg mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">Upload Video</div>
                            <div class="text-xs text-gray-500">Tambah konten baru</div>
                        </div>
                    </a>

                    <a href="#" class="group flex items-center p-4 border border-gray-200 hover:border-red-500 hover:bg-red-50 transition-all duration-200">
                        <div class="p-3 bg-red-500 group-hover:bg-red-600 transition-colors rounded-lg mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">Analytics</div>
                            <div class="text-xs text-gray-500">Lihat statistik</div>
                        </div>
                    </a>

                    <a href="#" class="group flex items-center p-4 border border-gray-200 hover:border-lime-500 hover:bg-lime-50 transition-all duration-200">
                        <div class="p-3 bg-lime-500 group-hover:bg-lime-600 transition-colors rounded-lg mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">Pengaturan</div>
                            <div class="text-xs text-gray-500">Konfigurasi sistem</div>
                        </div>
                    </a>

                    <a href="#" class="group flex items-center p-4 border border-gray-200 hover:border-red-500 hover:bg-red-50 transition-all duration-200">
                        <div class="p-3 bg-red-500 group-hover:bg-red-600 transition-colors rounded-lg mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-sm">Bantuan</div>
                            <div class="text-xs text-gray-500">Pusat bantuan</div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>