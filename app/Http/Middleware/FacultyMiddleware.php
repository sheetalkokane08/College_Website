<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FacultyMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isFaculty()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Forbidden - faculty only'], 403);
            }
            abort(403, 'Only faculty members may access this area');
        }

        return $next($request);
    }
}
