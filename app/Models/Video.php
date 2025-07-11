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
     */
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'original_filename',
        'duration',
    ];

    // =================================================================
    // TAMBAHKAN PROPERTI INI
    // =================================================================
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];
    // =================================================================


    /**
     * Accessor untuk mendapatkan URL lengkap ke file video.
     */
     public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

     public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}