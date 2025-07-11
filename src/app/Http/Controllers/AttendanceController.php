<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $attendances = Attendance::with('employee')->get();

        return response()->json($attendances);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,tidak_hadir,cuti',
            'description' => 'nullable|string',
        ]);

        $attendance = Attendance::create($validated);

        return response()->json($attendance, 201);
    }
}
