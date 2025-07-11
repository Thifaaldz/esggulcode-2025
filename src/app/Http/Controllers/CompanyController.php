<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        // Ambil semua data perusahaan
        $companies = Company::all();

        // Jika API Key tidak cocok, sembunyikan kolom sensitif
        if ($providedKey !== $expectedKey) {
            $companies->makeHidden(['email', 'phone', 'address', 'tax_number']);
        }

        return response()->json($companies);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'country' => 'nullable|string',
            'postal_code' => 'nullable|string',
            'tax_number' => 'nullable|string',
            'website' => 'nullable|string',
        ]);

        $company = Company::create($validated);

        return response()->json($company, 201);
    }
}
