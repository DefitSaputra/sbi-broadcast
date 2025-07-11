<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // migrations/create_schedules_table.php

public function up()
{
    // Pastikan semua kolom yang kamu butuhkan ada di sini dari awal
    Schema::create('schedules', function (Blueprint $table) {
        $table->id();

        // Kolom foreign key untuk relasi ke tabel video
        $table->foreignId('video_id')
              ->constrained('videos')
              ->onDelete('cascade');

        // Kolom title yang sebelumnya hilang
        $table->string('title'); 

        $table->dateTime('start_time');
        $table->dateTime('end_time');
        
        // Kolom running_text juga bisa langsung ditambahkan di sini
        // jika kamu belum punya data penting.
        $table->text('running_text')->nullable();

        $table->timestamps();
    });
}

};