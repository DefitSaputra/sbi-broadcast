<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recurring_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('video_id')->constrained()->onDelete('cascade');
            
            // Menyimpan hari sebagai array JSON, misal: [1, 3, 5] untuk Senin, Rabu, Jumat
            $table->json('days_of_week'); 
            
            $table->time('start_time'); // Hanya menyimpan jam, misal: 09:00:00
            $table->time('end_time');   // Hanya menyimpan jam, misal: 17:00:00
            
            $table->text('running_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recurring_schedules');
    }
};
