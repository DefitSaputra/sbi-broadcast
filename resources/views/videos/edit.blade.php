<head>
    <title>Edit - Broadcast Management System</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            {{-- Bagian Kiri: Judul dan Deskripsi --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl sm:tracking-tight truncate">
                    Edit Video
                </h2>
                <p class="mt-1 text-sm text-gray-600 truncate">
                    Memperbarui detail untuk: <span class="font-semibold">{{ $video->title }}</span>
                </p>
            </div>

            {{-- Bagian Kanan: Tombol Aksi "Kembali" --}}
            <div class="mt-4 flex-shrink-0 md:mt-0 md:ml-4">
                <a href="{{ route('videos.index') }}"
                   class="inline-flex items-center rounded-lg bg-transparent px-4 py-2 text-sm font-semibold text-sbi-red shadow-sm ring-2 ring-inset ring-sbi-red hover:bg-sbi-red hover:text-white transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Galeri</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl rounded-2xl">
                <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-800 mb-1">Judul Video</label>
                        <input type="text" name="title" id="title" class="block w-full bg-white border-gray-300 rounded-lg shadow-sm focus:ring-sbi-red focus:border-sbi-red sm:text-sm placeholder:text-gray-400" value="{{ old('title', $video->title) }}" required>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-800 mb-1">Deskripsi (Opsional)</label>
                        <textarea id="description" name="description" rows="4" class="block w-full bg-white border-gray-300 rounded-lg shadow-sm focus:ring-sbi-red focus:border-sbi-red sm:text-sm placeholder:text-gray-400">{{ old('description', $video->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-2">Video Saat Ini</label>
                        <video width="350" controls class="rounded-lg shadow-md border border-gray-200 bg-black">
                            <source src="{{ $video->url }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-800 mb-1">Ganti File Video (Opsional)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg bg-gray-50" id="dropzone">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="video_file" class="relative cursor-pointer bg-gray-50 rounded-md font-semibold text-sbi-red hover:text-red-600 focus-within:outline-none">
                                        <span>Unggah file baru</span>
                                        <input id="video_file" name="video_file" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">atau seret dan lepas</p>
                                </div>
                                <p class="text-xs text-gray-500" id="file-info">Kosongkan jika tidak ingin mengganti video</p>
                            </div>
                        </div>
                         <x-input-error :messages="$errors->get('video_file')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center justify-end pt-6 border-t border-gray-200">
                        <a href="{{ route('videos.index') }}" class="text-sm text-gray-700 hover:text-black mr-6 font-semibold">Batal</a>
                        <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-sbi-red border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sbi-red transition-all duration-200 ease-in-out">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script>
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('video_file');
            const fileInfo = document.getElementById('file-info');
            const defaultText = 'Kosongkan jika tidak ingin mengganti video';

            const dragoverClasses = ['border-sbi-green', 'bg-lime-50'];

            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add(...dragoverClasses);
            });
            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove(...dragoverClasses);
            });
            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove(...dragoverClasses);
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    const event = new Event('change');
                    fileInput.dispatchEvent(event);
                }
            });

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) {
                    fileInfo.textContent = fileInput.files[0].name;
                    fileInfo.classList.add('font-bold', 'text-sbi-green');
                } else {
                    fileInfo.textContent = defaultText;
                    fileInfo.classList.remove('font-bold', 'text-sbi-green');
                }
            });
        </script>
    @endpush
</x-app-layout>