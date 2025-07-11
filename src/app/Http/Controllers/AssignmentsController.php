<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $assignments = Assignments::with('module')->get();

        return response()->json($assignments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'nullable|date',
        ]);

        $assignment = Assignments::create($validated);

        return response()->json($assignment, 201);
    }
}
