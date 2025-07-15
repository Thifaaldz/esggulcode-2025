<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel event_courses
            $table->foreignId('event_course_id')
                ->constrained()
                ->cascadeOnDelete();

            // Informasi modul
            $table->integer('meeting_number'); // Nomor pertemuan ke-
            $table->string('title'); // Judul modul
            $table->text('description')->nullable(); // Deskripsi modul
            $table->string('ppt_path')->nullable(); // Path file ppt (storage)
            $table->string('video_url')->nullable(); // URL video (YouTube/Vimeo)
            $table->dateTime('meeting_datetime')->nullable();

            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
