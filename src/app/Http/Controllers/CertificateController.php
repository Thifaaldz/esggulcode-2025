<?php

namespace App\Http\Controllers;

use App\Models\AssignmentsSubmissions;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function print()
    {
        $student = Auth::user()->student;

        // Ambil event course yang diikuti siswa (asumsikan 1 event course aktif)
        $eventCourse = $student->eventCourse()->first(); // butuh relasi di model Student

        if (!$eventCourse) {
            abort(403, 'Kamu belum terdaftar dalam event course manapun.');
        }

        // Ambil semua assignment submission dari event course tersebut
        $submissionQuery = AssignmentsSubmissions::where('student_id', $student->id)
            ->whereHas('assignment.module', function ($query) use ($eventCourse) {
                $query->where('event_course_id', $eventCourse->id);
            });

        $grades = $submissionQuery->pluck('grade');
        $totalAssignments = $submissionQuery->count();

        // Validasi nilai semua tugas sudah minimal 80 dan lengkap
        if ($grades->count() < $eventCourse->modules->flatMap->assignments->count() ||
            $grades->contains(fn ($grade) => $grade < 80)) {
            abort(403, 'Kamu belum memenuhi syarat untuk mencetak sertifikat.');
        }

        $pdf = Pdf::loadView('pdf.certificate', [
            'student' => $student->user,
            'eventCourse' => $eventCourse,
            'companyName' => 'PT. ESGGUL CODE',
            'date' => now()->translatedFormat('d F Y'),
        ]);

        return $pdf->download('Sertifikat_' . str_replace(' ', '_', $student->user->name) . '.pdf');
    }
}
