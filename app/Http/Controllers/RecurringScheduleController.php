<?php

namespace App\Http\Controllers;

use App\Models\RecurringSchedule;
use App\Models\Video;
use Illuminate\Http\Request;

class RecurringScheduleController extends Controller
{
    public function index()
    {
        $schedules = RecurringSchedule::with('video')->orderBy('start_time')->get();
        $videos = Video::orderBy('title')->get();
        return view('recurring_schedules.index', compact('schedules', 'videos'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateSchedule($request);
        $formattedData = $this->formatDataForStorage($validatedData);
        RecurringSchedule::create($formattedData);
        return redirect()->route('recurring-schedules.index')->with('success', 'Jadwal berulang berhasil ditambahkan!');
    }

    public function edit(RecurringSchedule $recurring_schedule)
    {
        $schedules = RecurringSchedule::with('video')->orderBy('start_time')->get();
        $videos = Video::orderBy('title')->get();
        return view('recurring_schedules.index', [
            'schedules' => $schedules,
            'videos' => $videos,
            'scheduleToEdit' => $recurring_schedule
        ]);
    }

    public function update(Request $request, RecurringSchedule $recurring_schedule)
    {
        $validatedData = $this->validateSchedule($request);
        $formattedData = $this->formatDataForStorage($validatedData);
        $recurring_schedule->update($formattedData);
        return redirect()->route('recurring-schedules.index')->with('success', 'Jadwal berulang berhasil diperbarui!');
    }

    public function destroy(RecurringSchedule $recurring_schedule)
    {
        $recurring_schedule->delete();
        return redirect()->route('recurring-schedules.index')->with('success', 'Jadwal berulang berhasil dihapus!');
    }

    private function validateSchedule(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'video_id' => 'required|exists:videos,id',
            'days_of_week' => 'required|array|min:1',
            'days_of_week.*' => 'required|integer|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'running_text' => 'nullable|string',
        ]);
    }

    /**
     * PERBAIKAN FINAL: Menggabungkan semua format data di sini.
     */
    private function formatDataForStorage(array $data): array
    {
        // 1. Perbaiki masalah waktu (selisih detik)
        $data['start_time'] = $data['start_time'] . ':00';
        $data['end_time'] = $data['end_time'] . ':00';

        // 2. PERBAIKAN KUNCI: Paksa setiap item di 'days_of_week' menjadi integer
        // Ini mengubah ["3", "4", "5"] menjadi [3, 4, 5]
        $data['days_of_week'] = array_map('intval', $data['days_of_week']);

        return $data;
    }
}