<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $departments = Department::with('company')->get();

        // Tidak ada kolom sensitif di tabel departments, jadi tidak perlu disembunyikan
        // Namun, jika ingin membatasi akses berdasarkan API Key, bisa disesuaikan di sini

        return response()->json($departments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'nama' => 'required|string|max:255',
        ]);

        $department = Department::create($validated);

        return response()->json($department, 201);
    }
}
