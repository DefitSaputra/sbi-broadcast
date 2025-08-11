<head>
    <title>Manajemen Video - Broadcast Management System</title>
</head>

<x-app-layout>
    {{-- ====================================================== --}}
    {{-- Header dengan Efek Glassmorphism yang Ditingkatkan   --}}
    {{-- ====================================================== --}}
    <x-slot name="header">
        <div class="bg-white/70 backdrop-blur-lg rounded-xl shadow-lg p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl sm:tracking-tight">
                        {{ __('Galeri Video Broadcast') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Kelola semua aset video untuk siaran di satu tempat.
                    </p>
                </div>
                
                <div class="mt-4 flex-shrink-0 md:mt-0 md:ml-4">
                    <a href="{{ route('videos.create') }}" 
                       class="inline-flex items-center rounded-lg bg-sbi-red px-4 py-2 text-sm font-semibold text-white shadow-md hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sbi-red transition-all duration-200 ease-in-out hover:-translate-y-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span>Unggah Video Baru</span>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    {{-- ====================================================== --}}
    {{-- Konten Utama (tanpa background, agar transparan)     --}}
    {{-- ====================================================== --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                {{-- Notifikasi dibuat dengan efek glassmorphism juga --}}
                <div class="bg-sbi-green/20 backdrop-blur-lg border-l-4 border-sbi-green text-gray-800 p-4 mb-6 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if($videos->isEmpty())
                {{-- Kartu "Belum Ada Video" dibuat dengan efek glassmorphism --}}
                <div class="bg-white/70 backdrop-blur-lg rounded-xl shadow-lg text-center py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Video</h3>
                    <p class="mt-1 text-sm text-gray-500">Unggah video pertama Anda untuk memulai.</p>
                </div>
            @else
                {{-- Grid video tetap sama, karena kartunya sudah putih dan akan terlihat bagus --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($videos as $video)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <div class="relative">
                                <video class="w-full h-48 object-cover" controls preload="metadata">
                                    <source src="{{ $video->url }}#t=0.5" type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                                <div class="absolute top-0 right-0 bg-sbi-red text-white text-xs font-bold px-2 py-1 m-2 rounded-full">
                                    {{ $video->created_at->format('d M Y') }}
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-black text-gray-900 truncate" title="{{ $video->title }}">
                                    {{ $video->title }}
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $video->original_filename }}
                                </p>
                                <div class="mt-6 flex justify-between items-center">
                                    <a href="{{ route('videos.edit', $video) }}" class="inline-flex items-center px-4 py-2 bg-sbi-green text-black font-bold text-xs uppercase tracking-widest rounded-md hover:bg-opacity-90 transition">Edit</a>
                                    <form action="{{ route('videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini? Ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    {{ $videos->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>