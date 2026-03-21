<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * StudentMiddleware - Restrict access to student users only
 */
class StudentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isStudent()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthorized. Student access required.'], 403)
                : redirect('/')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
