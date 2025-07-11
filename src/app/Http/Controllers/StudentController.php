<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $students = Student::with(['user', 'eventCourse'])->get();

        return response()->json($students);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_course_id' => 'required|exists:event_courses,id',
            'phone' => 'required|string|max:20',
        ]);

        $student = Student::create($validated);

        return response()->json($student, 201);
    }
}
