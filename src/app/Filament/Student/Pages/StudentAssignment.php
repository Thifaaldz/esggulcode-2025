<?php

namespace App\Filament\Student\Pages;

use App\Models\Assignments;
use App\Models\AssignmentsSubmissions;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
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
        $this->assignments = Assignments::with('module')->get();
    }

    public function getSubmission($assignmentId)
    {
        return AssignmentsSubmissions::where('assignment_id', $assignmentId)
            ->where('student_id', auth()->user()->student->id)
            ->first();
    }

    public function submit($assignmentId)
    {
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
                'student_id' => auth()->user()->student->id,
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
        $studentId = auth()->user()->student->id;

        $submissions = AssignmentsSubmissions::where('student_id', $studentId)
            ->whereHas('assignment') // jaga-jaga relasi valid
            ->get();

        $totalAssignments = Assignments::count();

        // Pastikan jumlah tugas sesuai dan semua grade >= 80
        return $submissions->count() === $totalAssignments &&
            $submissions->every(fn($s) => $s->grade >= 80);
    }
}
