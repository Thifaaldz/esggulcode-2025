<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $modules = Module::with('eventCourse')->get();

        return response()->json($modules);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_course_id' => 'required|exists:event_courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ppt_path' => 'nullable|string',
            'video_url' => 'nullable|string',
            'meeting_number' => 'required|integer|min:1',
        ]);

        $module = Module::create($validated);

        return response()->json($module, 201);
    }
}
