<?php

namespace App\Http\Controllers;


use App\Models\AssignmentsSubmissions;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;

class AssignmentsSubmissionsController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $submissions = AssignmentsSubmissions::with(['assignment', 'student'])->get();

        return response()->json($submissions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'student_id' => 'required|exists:students,id',
            'file_path' => 'required|string',
            'notes' => 'nullable|string',
            'submitted_at' => 'nullable|date',
            'grade' => 'nullable|integer|min:0|max:100',
            'comment' => 'nullable|string',
        ]);

        $submission = AssignmentsSubmissions::create($validated);

        return response()->json($submission, 201);

    }
}
