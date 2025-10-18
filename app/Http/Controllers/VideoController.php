<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'required|file|mimetypes:video/mp4,video/webm,video/quicktime|max:102400', // Max 100MB
        ]);

        $file = $request->file('video_file');
        $originalFilename = $file->getClientOriginalName();
        $path = $file->store('videos', 'public');

        Video::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'file_path' => $path,
            'original_filename' => $originalFilename,
        ]);

        return redirect()->route('videos.index')->with('success', 'Video berhasil diunggah!');
    }

    public function show(Video $video)
    {
        return view('videos.edit', compact('video'));
    }


    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:102400',
        ]);

        $video->title = $validatedData['title'];
        $video->description = $validatedData['description'];

        if ($request->hasFile('video_file')) {
            Storage::disk('public')->delete($video->file_path);
            $file = $request->file('video_file');
            $originalFilename = $file->getClientOriginalName();
            $path = $file->store('videos', 'public');
            $video->file_path = $path;
            $video->original_filename = $originalFilename;
        }

        $video->save();

        return redirect()->route('videos.index')->with('success', 'Data video berhasil diperbarui!');
    }

    public function destroy(Video $video)
    {
        Storage::disk('public')->delete($video->file_path);
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus!');
    }

    
}
