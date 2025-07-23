<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecurringSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'title',
        'days_of_week', // Menyimpan hari dalam format JSON array [1,2,3]
        'start_time',   // Format time (08:00:00)
        'end_time',     // Format time (09:00:00)
        'running_text'
    ];

    protected $casts = [
        'days_of_week' => 'array', // Otomatis decode JSON ke array
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s'
    ];

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    // Accessor untuk memudahkan pembacaan
    public function getDaysOfWeekNamesAttribute()
    {
        $dayMap = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu'
        ];

        return array_map(function($day) use ($dayMap) {
            return $dayMap[$day] ?? $day;
        }, $this->days_of_week ?? []);
    }
}