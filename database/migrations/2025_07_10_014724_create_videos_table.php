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
    public function up()
    {
        // Membuat tabel 'videos' untuk menyimpan informasi video
        Schema::create('videos', function (Blueprint $table) {
            $table->id(); // Kolom ID auto-increment
            $table->string('title'); // Judul video
            $table->text('description')->nullable(); // Deskripsi video (opsional)
            $table->string('file_path'); // Path file video yang disimpan di storage
            $table->string('original_filename'); // Nama file asli saat diupload
            $table->integer('duration')->nullable(); // Durasi video dalam detik (opsional, bisa diisi nanti)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
