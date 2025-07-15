<?php

namespace App\Filament\Admin\Resources\EventCourseResource\Pages;

use App\Filament\Admin\Resources\EventCourseResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Module;
use App\Models\Assignments;
use Carbon\Carbon;

class CreateEventCourse extends CreateRecord
{
    protected static string $resource = EventCourseResource::class;

    protected function afterCreate(): void
    {
        $eventCourse = $this->record;
        $startDate = Carbon::parse($eventCourse->start_date);

        for ($i = 1; $i <= 8; $i++) {
            $meetingDate = $startDate->copy()->addWeeks($i - 1)->setTime(9, 0); // Misal pukul 09:00

            $module = Module::create([
                'event_course_id' => $eventCourse->id,
                'meeting_number' => $i,
                'title' => "Pertemuan $i",
                'description' => "Materi untuk pertemuan ke-$i.",
                'meeting_datetime' => $meetingDate, // <== PENTING
            ]);

            Assignments::create([
                'module_id' => $module->id,
                'title' => "Tugas Pertemuan $i",
                'description' => "Kerjakan soal pada pertemuan ke-$i.",
                'deadline' => $meetingDate->copy()->addDays(5),
            ]);
        }
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['image'])) {
            // Gambar random dari Picsum (pasti muncul)
            $data['image'] = 'https://picsum.photos/seed/' . uniqid() . '/600/400';
        }
    
        return $data;
    }
    
}
