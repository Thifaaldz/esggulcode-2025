<?php

namespace App\Http\Controllers;

use App\Models\PayrollCategory;
use Illuminate\Http\Request;

class PayrollCategoryController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        $categories = PayrollCategory::all();

        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:pendapatan,potongan',
        ]);

        $category = PayrollCategory::create($validated);

        return response()->json($category, 201);
    }
}
