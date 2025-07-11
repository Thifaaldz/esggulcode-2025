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

        $courses = EventCourse::with('branch')->get();

        return response()->json($courses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file_path' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price' => 'nullable|integer|min:0',
            'category' => 'required|string|max:100',
            'image' => 'nullable|string',
        ]);

        $eventCourse = EventCourse::create($validated);

        return response()->json($eventCourse, 201);
    }
}
