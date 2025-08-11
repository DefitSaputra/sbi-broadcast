<?php

// nama_file_migrasi.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recurring_schedules', function (Blueprint $table) {
            // Tambahkan kolom boolean 'is_active' setelah kolom 'end_time'
            // Defaultnya adalah true (aktif)
            $table->boolean('is_active')->default(true)->after('end_time'); 
        });
    }

    public function down(): void
    {
        Schema::table('recurring_schedules', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};