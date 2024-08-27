<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle(Request $request, \Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Authenticated users cannot access this resource.'
                    ], 403);
                }

                return redirect(route(auth()->user()->getDashboardRoute()));

            }
        }

        return $next($request);
    }

}
