<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'original_filename',
        'duration',
    ];

    /**
     * Accessor untuk mendapatkan URL lengkap ke file video.
     *
     * @return string
     */
      public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
