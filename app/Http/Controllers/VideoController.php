<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
        public function index()
    {
        // Ambil semua video, urutkan dari yang terbaru, dan gunakan paginasi
        $videos = Video::latest()->paginate(10);
        return view('videos.index', compact('videos'));
    }

    /**
     * Menampilkan form untuk membuat video baru.
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Menyimpan video baru ke database dan storage.
     */
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
        // Simpan di dalam folder 'videos' di disk 'public'
        $path = $file->store('videos', 'public');

        // 3. Simpan data ke database
        Video::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'file_path' => $path,
            'original_filename' => $originalFilename,
            // Logika untuk durasi bisa ditambahkan di sini menggunakan library seperti FFMpeg
        ]);

        // 4. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('videos.index')->with('success', 'Video berhasil diunggah!');
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
            'video_file' => 'nullable|file|mimetypes:video/mp4,video/webm,video/quicktime|max:102400', // Video tidak wajib diupdate
        ]);

        // 2. Update data teks
        $video->title = $validatedData['title'];
        $video->description = $validatedData['description'];

        // 3. Cek jika ada file video baru yang diupload
        if ($request->hasFile('video_file')) {
            // Hapus file video lama
            Storage::disk('public')->delete($video->file_path);

            // Simpan file video baru
            $file = $request->file('video_file');
            $originalFilename = $file->getClientOriginalName();
            $path = $file->store('videos', 'public');

            // Update path dan nama file di database
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
        // 1. Hapus file fisik dari storage
        Storage::disk('public')->delete($video->file_path);

        // 2. Hapus record dari database
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video berhasil dihapus!');
    }
}
