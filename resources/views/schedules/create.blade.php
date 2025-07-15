<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Jadwal Penayangan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="video_id" class="block font-medium">Pilih Video</label>
                    <select name="video_id" id="video_id" class="w-full mt-1 border-gray-300 rounded">
                        @foreach ($videos as $video)
                            <option value="{{ $video->id }}">{{ $video->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="start_time" class="block font-medium">Tanggal & Waktu Tayang</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="w-full mt-1 border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="start_from" class="block font-medium">Mulai Dari Detik ke-</label>
                    <input type="number" name="start_from" id="start_from" class="w-full mt-1 border-gray-300 rounded" min="0" value="0" required>
                </div>

                <div class="mb-4">
                    <label for="duration" class="block font-medium">Durasi Tayang (dalam detik)</label>
                    <input type="number" name="duration" id="duration" class="w-full mt-1 border-gray-300 rounded" min="1" value="60" required>
                </div>

                <div class="mb-4">
                    <label for="status" class="block font-medium">Status</label>
                    <select name="status" id="status" class="w-full mt-1 border-gray-300 rounded">
                        <option value="scheduled">Terjadwal</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Simpan Jadwal
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
