<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $positions = Position::with('division')->get();

        return response()->json($positions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255',
            'basic_salary' => 'nullable|numeric|min:0',
        ]);

        $position = Position::create($validated);

        return response()->json($position, 201);
    }
}
