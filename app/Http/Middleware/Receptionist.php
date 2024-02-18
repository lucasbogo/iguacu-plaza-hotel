<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceptionistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard The guard to use for authentication.
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = 'receptionist')
    {
        if (!Auth::guard($guard)->check()) {
            // Not authenticated, redirect to login
            return redirect(route('login'));
        }

        // The user is authenticated with the receptionist guard, proceed with the request
        return $next($request);
    }
}
