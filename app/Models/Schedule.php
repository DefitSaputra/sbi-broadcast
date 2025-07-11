<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     * Pastikan semua kolom dari form ada di sini.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'video_id',
        'title',
        'start_time',
        'end_time',
        'running_text', // <-- Pastikan ini ada
    ];

    /**
     * Memberitahu Laravel cara menangani tipe data kolom tertentu.
     * Ini sangat penting untuk kolom tanggal dan waktu.
     *
     * @var array
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Mendefinisikan relasi bahwa setiap jadwal memiliki satu video.
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
