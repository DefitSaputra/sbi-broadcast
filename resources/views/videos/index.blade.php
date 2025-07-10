<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Galeri Video Broadcast') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer utama dengan gaya kartu --}}
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4 md:mb-0">Daftar Video Anda</h3>
                        {{-- Tombol utama dengan warna merah --}}
                        <a href="{{ route('videos.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Unggah Video Baru
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-lime-100 border border-lime-400 text-lime-800 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($videos as $index => $video)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $videos->firstItem() + $index }}</td>
                                        <td class="px-6 py-4">
                                            <video width="200" class="rounded-md" controls>
                                                <source src="{{ $video->url }}" type="video/mp4">
                                                Browser Anda tidak mendukung tag video.
                                            </video>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $video->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('videos.edit', $video) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>
                                            <form action="{{ route('videos.destroy', $video) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus video ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4 font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Belum ada video yang diunggah. Klik "Unggah Video Baru" untuk memulai.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
