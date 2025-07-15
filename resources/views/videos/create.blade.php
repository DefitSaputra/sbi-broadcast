<head>
    <title>Create - Broadcast Management System</title>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Unggah Video Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-bold text-gray-700">Judul Video</label>
                        <div class="mt-1">
                            <input type="text" name="title" id="title" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-sbi-green focus:border-sbi-green sm:text-sm" placeholder="Contoh: Profil Perusahaan SBI" value="{{ old('title') }}" required>
                        </div>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700">Deskripsi (Opsional)</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="4" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-sbi-green focus:border-sbi-green sm:text-sm" placeholder="Jelaskan isi video secara singkat...">{{ old('description') }}</textarea>
                        </div>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700">File Video</label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" id="dropzone">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="video_file" class="relative cursor-pointer bg-white rounded-md font-medium text-sbi-red hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-sbi-red">
                                        <span>Unggah sebuah file</span>
                                        <input id="video_file" name="video_file" type="file" class="sr-only" required>
                                    </label>
                                    <p class="pl-1">atau seret dan lepas</p>
                                </div>
                                <p class="text-xs text-gray-500" id="file-info">MP4, WEBM hingga 100MB</p>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('video_file')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center justify-end pt-5 border-t border-gray-200">
                        <a href="{{ route('videos.index') }}" class="text-sm text-gray-600 hover:underline mr-6 font-medium">Batal</a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-sbi-red border border-transparent rounded-md font-bold text-sm text-white uppercase tracking-widest hover:bg-opacity-90 transition">
                            Unggah Video
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

            dropzone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropzone.classList.add('border-sbi-green', 'bg-lime-50');
            });

            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-sbi-green', 'bg-lime-50');
            });

            dropzone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropzone.classList.remove('border-sbi-green', 'bg-lime-50');
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    fileInfo.textContent = e.dataTransfer.files[0].name;
                }
            });

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) {
                    fileInfo.textContent = fileInput.files[0].name;
                } else {
                    fileInfo.textContent = 'MP4, WEBM hingga 100MB';
                }
            });
        </script>
    @endpush
</x-app-layout>