<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Video: ') . $video->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div>
                            <x-input-label for="title" class="font-semibold" :value="__('Judul Video')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $video->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-6">
                            <x-input-label for="description" class="font-semibold" :value="__('Deskripsi (Opsional)')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $video->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Video Saat Ini -->
                        <div class="mt-6">
                            <x-input-label class="font-semibold" :value="__('Video Saat Ini')" />
                            <video width="300" controls class="mt-2 rounded-md shadow-md">
                                <source src="{{ $video->url }}" type="video/mp4">
                            </video>
                        </div>

                        <!-- File Video Baru -->
                        <div class="mt-6">
                            <x-input-label for="video_file" class="font-semibold" :value="__('Unggah File Baru (Kosongkan jika tidak ingin mengganti)')" />
                            <input id="video_file" type="file" name="video_file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-gray-800 file:text-white file:p-2 file:border-0">
                            <x-input-error :messages="$errors->get('video_file')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t pt-6">
                            <a href="{{ route('videos.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4 font-medium">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
