<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Bypass path yang bukan API (Livewire, web, dll)
        $excludedPaths = [
            'livewire/message/*',
            'livewire/*',
            'register/*',
            'payment/finish',
            'midtrans/*',
        ];

        foreach ($excludedPaths as $path) {
            if ($request->is($path)) {
                Log::info("Bypass apikey middleware for: " . $request->path());
                return $next($request);
            }
        }

        // Hanya jalankan validasi untuk route yang diminta JSON (API)
        if (!$request->is('api/*')) {
            return $next($request);
        }

        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        if (!$expectedKey || $providedKey !== $expectedKey) {
            Log::warning("Unauthorized API: {$request->path()}, IP: {$request->ip()}");
            return response()->json(['message' => 'Unauthorized: Invalid or missing API Key'], 401);
        }

        return $next($request);
    }
}
