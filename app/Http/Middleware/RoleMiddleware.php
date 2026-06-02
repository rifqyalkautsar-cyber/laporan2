<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah yang login punya role yang sesuai (admin)
        if ($request->user()->role !== $role) {
            return response()->json(['message' => 'Akses ditolak. Anda bukan Admin.'], 403);
        }

        return $next($request);
    }
}