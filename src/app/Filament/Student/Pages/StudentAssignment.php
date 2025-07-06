<?php

namespace App\Filament\Student\Pages;

use App\Models\Assignments;
use App\Models\AssignmentsSubmissions;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class StudentAssignment extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.student.pages.student-assignment';

    public $assignments;
    public $files = [];

    public function mount()
    {
        $student = auth()->user()->student;

        // Ambil hanya assignments dari event_course yang diikuti student
        $this->assignments = Assignments::whereHas('module.eventCourse.students', function ($query) use ($student) {
            $query->where('students.id', $student->id);
        })
        ->with('module.eventCourse')
        ->get();
    }

    public function getSubmission($assignmentId)
    {
        return AssignmentsSubmissions::where('assignment_id', $assignmentId)
            ->where('student_id', auth()->user()->student->id)
            ->first();
    }

    public function submit($assignmentId)
    {
        $student = auth()->user()->student;

        $assignment = Assignments::with('module.eventCourse.students')->findOrFail($assignmentId);

        // Pastikan student hanya submit assignment miliknya
        if (!$assignment->module->eventCourse->students->contains($student->id)) {
            abort(403, 'Kamu tidak berhak mengakses tugas ini.');
        }

        $file = $this->files[$assignmentId] ?? null;

        if (!$file) {
            Notification::make()
                ->title('File belum dipilih.')
                ->danger()
                ->send();
            return;
        }

        $path = $file->store('assignment-submissions', 'public');

        AssignmentsSubmissions::updateOrCreate(
            [
                'assignment_id' => $assignmentId,
                'student_id' => $student->id,
            ],
            [
                'file_path' => $path,
            ]
        );

        Notification::make()
            ->title('Tugas berhasil diunggah.')
            ->success()
            ->send();

        $this->files[$assignmentId] = null;
    }

    public function hasPassedAllAssignments(): bool
    {
        $student = auth()->user()->student;

        // Ambil semua assignment dari event yang diikuti student
        $assignmentIds = Assignments::whereHas('module.eventCourse.students', function ($q) use ($student) {
            $q->where('students.id', $student->id);
        })->pluck('id');

        $submissions = AssignmentsSubmissions::where('student_id', $student->id)
            ->whereIn('assignment_id', $assignmentIds)
            ->get();

        $totalAssignments = $assignmentIds->count();

        return $submissions->count() === $totalAssignments &&
            $submissions->every(fn($s) => $s->grade >= 80);
    }
}
