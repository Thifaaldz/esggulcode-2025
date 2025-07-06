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

        // Ambil semua nilai dari assignment 1 sampai 8
        $grades = AssignmentsSubmissions::where('student_id', $student->id)
            ->whereBetween('assignment_id', [1, 8])
            ->pluck('grade');

        // Validasi: Semua tugas harus sudah ada nilainya, dan minimal 80
        if ($grades->count() < 8 || $grades->contains(fn($grade) => $grade < 80)) {
            abort(403, 'Kamu belum memenuhi syarat untuk mencetak sertifikat.');
        }

        // Generate PDF dengan data siswa (pastikan 'pdf.certificate' sudah ada)
        $pdf = Pdf::loadView('pdf.certificate', [
            'student' => $student->user,
            'date' => now()->translatedFormat('d F Y'),
        ]);

        return $pdf->download('Sertifikat_' . str_replace(' ', '_', $student->user->name) . '.pdf');
    }
}
