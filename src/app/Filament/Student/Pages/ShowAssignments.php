<?php

namespace App\Filament\Student\Pages;

use App\Models\Assignment;
use App\Models\Assignments;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class ShowAssignments extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static string $view = 'filament.student.pages.show-assignments';
    protected static ?string $title = 'Tugas Saya';
    protected static ?string $navigationLabel = 'Tugas';
    protected static ?int $navigationSort = 3;

    public $assignments;

    public function mount()
    {
        $student = Auth::user()->student;

        if (!$student || !$student->eventCourse) {
            $this->assignments = collect();
            return;
        }

        $this->assignments = Assignments::whereHas('module', function ($query) use ($student) {
            $query->where('event_course_id', $student->event_course_id);
        })->with('module')->get();
    }
}
