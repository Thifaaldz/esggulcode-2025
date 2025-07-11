<?php

namespace App\Http\Controllers;

use App\Models\PayrollDetail;
use Illuminate\Http\Request;

class PayrollDetailController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $details = PayrollDetail::with(['employee', 'salaryPeriod', 'payrollCategory'])->get();

        return response()->json($details);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'salary_period_id' => 'required|exists:salary_periods,id',
            'payroll_category_id' => 'required|exists:payroll_categories,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $detail = PayrollDetail::create($validated);

        return response()->json($detail, 201);
    }
}
