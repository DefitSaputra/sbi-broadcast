{{-- Menggunakan layout utama aplikasi agar navigasi dan header konsisten --}}
<x-app-layout>
    {{-- Judul Halaman yang akan muncul di header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Jadwal Siaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Kolom Kiri: Form Create / Edit --}}
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            @if(isset($scheduleToEdit))
                                Edit Jadwal
                            @else
                                Tambah Jadwal Baru
                            @endif
                        </h3>

                        <form action="{{ isset($scheduleToEdit) ? route('schedules.update', $scheduleToEdit->id) : route('schedules.store') }}" method="POST">
                            @csrf
                            @if(isset($scheduleToEdit))
                                @method('PUT')
                            @endif

                            <div class="space-y-4">
                                {{-- Judul Acara --}}
                                <div>
                                    <x-input-label for="title" :value="__('Judul Acara')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $scheduleToEdit->title ?? '')" required autofocus />
                                </div>

                                {{-- Pilih Video --}}
                                <div>
                                    <x-input-label for="video_id" :value="__('Pilih Video')" />
                                    <select id="video_id" name="video_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="">-- Pilih Video --</option>
                                        @foreach ($videos as $video)
                                            <option value="{{ $video->id }}" @selected(old('video_id', $scheduleToEdit->video_id ?? '') == $video->id)>
                                                {{ $video->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Waktu Mulai --}}
                                <div>
                                    <x-input-label for="start_time" :value="__('Waktu Mulai')" />
                                    <x-text-input id="start_time" class="block mt-1 w-full" type="datetime-local" name="start_time" :value="old('start_time', isset($scheduleToEdit) ? \Carbon\Carbon::parse($scheduleToEdit->start_time)->format('Y-m-d\TH:i') : '')" required />
                                </div>

                                {{-- Waktu Selesai --}}
                                <div>
                                    <x-input-label for="end_time" :value="__('Waktu Selesai')" />
                                    <x-text-input id="end_time" class="block mt-1 w-full" type="datetime-local" name="end_time" :value="old('end_time', isset($scheduleToEdit) ? \Carbon\Carbon::parse($scheduleToEdit->end_time)->format('Y-m-d\TH:i') : '')" required />
                                </div>

                                {{-- Running Text --}}
                                <div>
                                    <x-input-label for="running_text" :value="__('Running Text (Opsional)')" />
                                    <textarea id="running_text" name="running_text" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('running_text', $scheduleToEdit->running_text ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center gap-4">
                                <x-primary-button>
                                    @if(isset($scheduleToEdit))
                                        {{ __('Perbarui Jadwal') }}
                                    @else
                                        {{ __('Simpan Jadwal') }}
                                    @endif
                                </x-primary-button>

                                @if(isset($scheduleToEdit))
                                    <a href="{{ route('schedules.index') }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Batal') }}</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Kolom Kanan: Daftar Jadwal --}}
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul Acara & Video</th>
                                    <th scope="col" class="px-6 py-3">Waktu Tayang</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $schedule)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900">{{ $schedule->title }}</div>
                                            <div class="text-xs text-gray-500">{{ $schedule->video->title }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div>Mulai: <span class="font-mono">{{ \Carbon\Carbon::parse($schedule->start_time)->format('d M Y, H:i') }}</span></div>
                                            <div>Selesai: <span class="font-mono">{{ \Carbon\Carbon::parse($schedule->end_time)->format('d M Y, H:i') }}</span></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-2">
                                                <a href="{{ route('schedules.edit', $schedule->id) }}" class="font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus jadwal ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center px-6 py-12 text-gray-400">
                                            Belum ada jadwal yang dibuat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>