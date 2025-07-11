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
        // 1. Validasi input dari form
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'required|file|mimetypes:video/mp4,video/webm,video/quicktime|max:102400', // Max 100MB
        ]);

        // 2. Simpan file video ke storage
        $file = $request->file('video_file');
        $originalFilename = $file->getClientOriginalName();
        $path = $file->store('videos', 'public');

        // 3. Simpan data ke database
        Video::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'file_path' => $path,
            'original_filename' => $originalFilename,
        ]);

        // 4. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('videos.index')->with('success', 'Video berhasil diunggah!');
    }

    /**
     * --- PERBAIKAN: Menambahkan method show() yang hilang ---
     * Menampilkan detail satu video.
     * (Untuk saat ini, kita arahkan saja ke halaman edit)
     */
    public function show(Video $video)
    {
        // Anda bisa membuat view khusus 'videos.show' jika perlu,
        // tapi untuk sekarang, mengarahkan ke halaman edit sudah cukup.
        return view('videos.edit', compact('video'));
    }


    /**
     * Menampilkan form untuk mengedit video.
     */
    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    /**
     * Mengupdate data video di database dan storage.
     */
    public function update(Request $request, Video $video)
    {
        // 1. Validasi input
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:102400',
        ]);

        // 2. Update data teks
        $video->title = $validatedData['title'];
        $video->description = $validatedData['description'];

        // 3. Cek jika ada file video baru yang diupload
        if ($request->hasFile('video_file')) {
            Storage::disk('public')->delete($video->file_path);
            $file = $request->file('video_file');
            $originalFilename = $file->getClientOriginalName();
            $path = $file->store('videos', 'public');
            $video->file_path = $path;
            $video->original_filename = $originalFilename;
        }

        // 4. Simpan perubahan
        $video->save();

        return redirect()->route('videos.index')->with('success', 'Data video berhasil diperbarui!');
    }

    /**
     * Menghapus video dari database dan storage.
     */
    public function destroy(Video $video)
    {
        Storage::disk('public')->delete($video->file_path);
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus!');
    }

    
}
