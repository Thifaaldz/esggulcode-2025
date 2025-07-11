<?php

namespace App\Http\Controllers;

use App\Models\SalaryPeriod;
use Illuminate\Http\Request;

class SalaryPeriodController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $periods = SalaryPeriod::all();

        return response()->json($periods);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:1900|max:2100',
        ]);

        $period = SalaryPeriod::create($validated);

        return response()->json($period, 201);
    }
}
