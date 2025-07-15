<head>
    <title>Manajemen Video - Broadcast Management System</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4 md:mb-0">
                {{ __('Galeri Video Broadcast') }}
            </h2>
            <a href="{{ route('videos.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-sbi-red border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sbi-red transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                Unggah Video Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-sbi-green/20 border-l-4 border-sbi-green text-gray-800 p-4 mb-6 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if($videos->isEmpty())
                <div class="text-center py-16">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Video</h3>
                    <p class="mt-1 text-sm text-gray-500">Unggah video pertama Anda untuk memulai.</p>
                </div>
            @else
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