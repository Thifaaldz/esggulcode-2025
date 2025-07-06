<?php

namespace App\Filament\Student\Pages;

use App\Models\Module;
use Filament\Pages\Page;

class StudentModules extends Page
{
    protected static string $view = 'filament.student.pages.student-modules';

    public $modules;

    public function mount()
    {
        $student = auth()->user()->student;

        // Asumsikan satu student hanya ikut satu event_course
        $this->modules = Module::where('event_course_id', $student->event_course_id)
                               ->orderBy('meeting_number')
                               ->get();
    }
}