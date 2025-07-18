<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'video_id',
        'days_of_week',
        'start_time',
        'end_time',
        'running_text',
    ];

    /**
     * Memberitahu Laravel untuk secara otomatis mengubah
     * kolom JSON 'days_of_week' menjadi array PHP.
     */
    protected $casts = [
        'days_of_week' => 'array',
    ];

    /**
     * Mendefinisikan relasi bahwa setiap jadwal berulang
     * memiliki satu video.
     */
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
