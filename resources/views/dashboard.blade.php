<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Hero Section dengan Gambar Latar --}}
            <div class="relative bg-white shadow-xl sm:rounded-lg overflow-hidden mb-8">
                {{-- Gambar Latar --}}
                <div class="absolute inset-0">
                    <img class="h-full w-full object-cover" src="{{ asset('images/bg-sbi3.jpeg') }}" alt="Latar belakang industri">
                    {{-- Overlay Gelap --}}
                    <div class="absolute inset-0 bg-gray-900 bg-opacity-60"></div>
                </div>
                
                {{-- Konten Teks di atas Gambar --}}
                <div class="relative px-6 py-16 sm:px-12 sm:py-24 lg:px-16">
                    <h1 class="text-center text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">
                        <span class="block text-white">Selamat Datang di</span>
                        <span class="block text-lime-400">Broadcast Management</span>
                    </h1>
                    <p class="mx-auto mt-6 max-w-lg text-center text-xl text-gray-200">
                        Atur, jadwalkan, dan siarkan konten video Anda dengan mudah dan efisien.
                    </p>
                    <div class="mx-auto mt-10 max-w-sm sm:flex sm:max-w-none sm:justify-center">
                        <a href="{{ route('videos.index') }}" class="flex items-center justify-center rounded-md border border-transparent bg-red-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-red-700 sm:px-8">
                            Mulai Mengelola Video
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kartu Aksi Cepat --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kartu 1: Menuju Galeri Video -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900">Galeri Video</h3>
                    <p class="mt-2 text-sm text-gray-600">Lihat, edit, atau hapus semua video yang telah Anda unggah.</p>
                    <a href="{{ route('videos.index') }}" class="mt-4 inline-block text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                        Buka Galeri &rarr;
                    </a>
                </div>

                <!-- Kartu 2: Menuju Penjadwalan (Placeholder) -->
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900">Penjadwalan Siaran</h3>
                    <p class="mt-2 text-sm text-gray-600">Atur jadwal tayang untuk setiap video di galeri Anda.</p>
                    <a href="#" class="mt-4 inline-block text-sm font-semibold text-gray-400 cursor-not-allowed" title="Fitur segera hadir">
                        Buka Jadwal &rarr;
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
