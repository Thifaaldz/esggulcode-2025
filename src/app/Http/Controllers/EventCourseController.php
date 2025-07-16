<?php

namespace App\Http\Controllers;

use App\Models\EventCourse;
use Illuminate\Http\Request;

class EventCourseController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        // Validasi API key jika diperlukan
        if ($expectedKey && $expectedKey !== $providedKey) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $courses = EventCourse::with(['branch', 'instructor'])->get();

        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id',
            'instructor_id' => 'required|exists:employees,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'nullable|integer|min:0',
            'category' => 'required|string|max:100',
            'image' => 'nullable|string',
        ]);

        // Set default price jika null
        if (!isset($validated['price'])) {
            $validated['price'] = 0;
        }

        $eventCourse = EventCourse::create($validated);

        return response()->json($eventCourse, 201);
    }
}
