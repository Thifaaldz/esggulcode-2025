<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $divisions = Division::with('department')->get();

        return response()->json($divisions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'nama' => 'required|string|max:255',
        ]);

        $division = Division::create($validated);

        return response()->json($division, 201);
    }
}
