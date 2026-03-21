<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * AdminMiddleware - Restrict access to admin users only
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthorized. Admin access required.'], 403)
                : redirect('/')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
