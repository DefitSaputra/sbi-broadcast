<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Video;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('video')->latest()->get();
        $videos = Video::orderBy('title')->get();
        return view('schedules.index', compact('schedules', 'videos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'video_id' => 'required|exists:videos,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'running_text' => 'nullable|string',
        ]);

        Schedule::create($validatedData);

        return redirect()->route('schedules.index')->with('success', 'Jadwal siaran berhasil ditambahkan!');
    }

    public function edit(Schedule $schedule)
    {
        $schedules = Schedule::with('video')->latest()->get();
        $videos = Video::orderBy('title')->get(); 
        
        return view('schedules.index', [
            'schedules' => $schedules,
            'videos' => $videos,
            'scheduleToEdit' => $schedule
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'video_id' => 'required|exists:videos,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'running_text' => 'nullable|string',
        ]);

        $schedule->update($validatedData);

        return redirect()->route('schedules.index')->with('success', 'Jadwal siaran berhasil diperbarui!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Jadwal siaran berhasil dihapus!');
    }
}