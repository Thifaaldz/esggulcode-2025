<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $branches = Branch::with('company')->get();

        return response()->json($branches);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $branch = Branch::create($validated);

        return response()->json($branch, 201);
    }
}
