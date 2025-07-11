<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiKeyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $excludedPaths = [
            'midtrans/manual-callback', // Pastikan ini sesuai route kamu
            'payment/finish', // Jika ingin dilepas dari validasi
        ];

        Log::info('Request path: ' . $request->path());

        if (in_array($request->path(), $excludedPaths)) {
            return $next($request);
        }

        $expectedKey = env('API_KEY');
        $providedKey = $request->header('X-API-KEY');

        if ($providedKey !== $expectedKey) {
            Log::warning('Unauthorized request - Invalid API Key from IP: ' . $request->ip());
            return response()->json(['message' => 'Unauthorized: Invalid API Key'], 401);
        }

        return $next($request);
    }
}
