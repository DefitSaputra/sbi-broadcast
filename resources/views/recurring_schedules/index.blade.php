<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Jadwal Berulang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-sbi-green/20 border-l-4 border-sbi-green text-gray-800 p-4 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Kolom Kiri: Form --}}
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6">
                        <h3 class="text-xl font-black text-gray-900 mb-4">
                            @isset($scheduleToEdit)
                                Edit Jadwal Berulang
                            @else
                                Tambah Jadwal Berulang
                            @endisset
                        </h3>

                        <form action="{{ isset($scheduleToEdit) ? route('recurring-schedules.update', $scheduleToEdit->id) : route('recurring-schedules.store') }}" method="POST">
                            @csrf
                            @isset($scheduleToEdit)
                                @method('PUT')
                            @endisset

                            <div class="space-y-6">
                                {{-- Judul & Video --}}
                                <div>
                                    <x-input-label for="title" value="Judul Acara" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $scheduleToEdit->title ?? '')" required />
                                </div>
                                <div>
                                    <x-input-label for="video_id" value="Pilih Video" />
                                    <select id="video_id" name="video_id" class="block mt-1 w-full border-gray-300 focus:border-sbi-green focus:ring-sbi-green rounded-md shadow-sm" required>
                                        <option value="">-- Pilih Video --</option>
                                        @foreach ($videos as $video)
                                            <option value="{{ $video->id }}" @selected(old('video_id', $scheduleToEdit->video_id ?? '') == $video->id)>
                                                {{ $video->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Hari Tayang --}}
                                <div>
                                    <x-input-label value="Hari Tayang" class="mb-2"/>
                                    <div class="grid grid-cols-3 gap-2 text-sm">
                                        @php
                                            $days = [1 => 'Sen', 2 => 'Sel', 3 => 'Rab', 4 => 'Kam', 5 => 'Jum', 6 => 'Sab', 0 => 'Min'];
                                            $selectedDays = old('days_of_week', $scheduleToEdit->days_of_week ?? []);
                                        @endphp
                                        @foreach($days as $value => $label)
                                        <label class="flex items-center space-x-2 p-2 border rounded-md hover:bg-gray-50">
                                            <input type="checkbox" name="days_of_week[]" value="{{ $value }}" @checked(in_array($value, $selectedDays)) class="rounded text-sbi-red focus:ring-sbi-red">
                                            <span>{{ $label }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('days_of_week')" class="mt-2" />
                                </div>

                                {{-- Jam Tayang --}}
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="start_time" value="Jam Mulai" />
                                        <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time" :value="old('start_time', $scheduleToEdit->start_time ?? '')" required />
                                    </div>
                                    <div>
                                        <x-input-label for="end_time" value="Jam Selesai" />
                                        <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time" :value="old('end_time', $scheduleToEdit->end_time ?? '')" required />
                                    </div>
                                </div>

                                {{-- Running Text --}}
                                <div>
                                    <x-input-label for="running_text" value="Running Text (Opsional)" />
                                    <textarea id="running_text" name="running_text" rows="3" class="block mt-1 w-full border-gray-300 focus:border-sbi-green focus:ring-sbi-green rounded-md shadow-sm">{{ old('running_text', $scheduleToEdit->running_text ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center gap-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-sbi-red text-white font-bold text-xs uppercase rounded-md hover:bg-opacity-90 transition">
                                    @isset($scheduleToEdit) Perbarui @else Simpan @endisset
                                </button>
                                @isset($scheduleToEdit)
                                    <a href="{{ route('recurring-schedules.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                                @endisset
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Kolom Kanan: Daftar Jadwal Berulang --}}
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul Acara & Video</th>
                                    <th scope="col" class="px-6 py-3">Jadwal Tayang</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($schedules as $schedule)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">{{ $schedule->title }}</div>
                                            <div class="text-xs text-gray-500">{{ $schedule->video->title }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-1 mb-2">
                                                @foreach($schedule->days_of_week as $day)
                                                    <span class="bg-sbi-green text-black text-xs font-bold px-2 py-1 rounded-full">{{ $days[$day] }}</span>
                                                @endforeach
                                            </div>
                                            <div class="font-mono text-xs">
                                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex gap-4">
                                                <a href="{{ route('recurring-schedules.edit', $schedule->id) }}" class="font-medium text-indigo-600 hover:underline">Edit</a>
                                                <form action="{{ route('recurring-schedules.destroy', $schedule->id) }}" method="POST" onsubmit="return confirm('Anda yakin?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center px-6 py-12 text-gray-400">
                                            Belum ada jadwal berulang yang dibuat.
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
