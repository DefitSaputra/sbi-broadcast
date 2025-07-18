<?php

namespace App\Http\Controllers;

use App\Models\RecurringSchedule;
use App\Models\Video;
use Illuminate\Http\Request;

class RecurringScheduleController extends Controller
{
    public function index()
    {
        $schedules = RecurringSchedule::with('video')->latest()->get();
        $videos = Video::orderBy('title')->get();
        return view('recurring_schedules.index', compact('schedules', 'videos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'video_id' => 'required|exists:videos,id',
            'days_of_week' => 'required|array|min:1',
            'days_of_week.*' => 'required|integer|between:0,6', // 0=Minggu, 6=Sabtu
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'running_text' => 'nullable|string',
        ]);

        RecurringSchedule::create($validatedData);

        return redirect()->route('recurring-schedules.index')->with('success', 'Jadwal berulang berhasil ditambahkan!');
    }

    public function edit(RecurringSchedule $recurring_schedule)
    {
        $schedules = RecurringSchedule::with('video')->latest()->get();
        $videos = Video::orderBy('title')->get();
        
        return view('recurring_schedules.index', [
            'schedules' => $schedules,
            'videos' => $videos,
            'scheduleToEdit' => $recurring_schedule
        ]);
    }

    public function update(Request $request, RecurringSchedule $recurring_schedule)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'video_id' => 'required|exists:videos,id',
            'days_of_week' => 'required|array|min:1',
            'days_of_week.*' => 'required|integer|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'running_text' => 'nullable|string',
        ]);

        $recurring_schedule->update($validatedData);

        return redirect()->route('recurring-schedules.index')->with('success', 'Jadwal berulang berhasil diperbarui!');
    }

    public function destroy(RecurringSchedule $recurring_schedule)
    {
        $recurring_schedule->delete();
        return redirect()->route('recurring-schedules.index')->with('success', 'Jadwal berulang berhasil dihapus!');
    }
}
