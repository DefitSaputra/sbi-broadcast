<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Jadwal') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="video_id" class="block font-medium">Pilih Video</label>
                    <select name="video_id" id="video_id" class="w-full mt-1 border-gray-300 rounded">
                        @foreach ($videos as $video)
                            <option value="{{ $video->id }}" {{ $schedule->video_id == $video->id ? 'selected' : '' }}>
                                {{ $video->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="start_time" class="block font-medium">Tanggal & Waktu Tayang</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="w-full mt-1 border-gray-300 rounded" 
                        value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('Y-m-d\TH:i') }}" required>
                </div>

                <div class="mb-4">
                    <label for="start_from" class="block font-medium">Mulai Dari Detik ke-</label>
                    <input type="number" name="start_from" id="start_from" class="w-full mt-1 border-gray-300 rounded" min="0" 
                        value="{{ $schedule->start_from ?? 0 }}" required>
                </div>

                <div class="mb-4">
                    <label for="duration" class="block font-medium">Durasi Tayang (dalam detik)</label>
                    <input type="number" name="duration" id="duration" class="w-full mt-1 border-gray-300 rounded" min="1" 
                        value="{{ $schedule->duration ?? 60 }}" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block font-medium">Status</label>
                    <select name="status" id="status" class="w-full mt-1 border-gray-300 rounded">
                        <option value="scheduled" {{ $schedule->status === 'scheduled' ? 'selected' : '' }}>Terjadwal</option>
                        <option value="draft" {{ $schedule->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Jadwal
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
