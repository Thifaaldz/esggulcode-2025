<?php

namespace Database\Seeders;

use App\Models\EventCourse;
use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $eventCourses = EventCourse::all();

        foreach ($eventCourses as $eventCourse) {
            for ($i = 1; $i <= 8; $i++) {
                Module::create([
                    'event_course_id' => $eventCourse->id,
                    'title' => "Pertemuan $i - Materi {$eventCourse->title}",
                    'meeting_number' => $i,
                    'video_url' => 'https://www.youtube.com/watch?v=NBZ9Ro6UKV8&list=PLFIM0718LjIVuONHysfOK0ZtiqUWvrx4F', // dummy video
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
