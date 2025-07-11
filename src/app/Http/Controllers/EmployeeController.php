<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        // Load relasi user, branch, position
        $employees = Employee::with(['user', 'branch', 'position'])->get();

        return response()->json($employees);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'branch_id' => 'required|exists:branches,id',
            'position_id' => 'required|exists:positions,id',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'telepon' => 'nullable|string|max:20',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }
}
