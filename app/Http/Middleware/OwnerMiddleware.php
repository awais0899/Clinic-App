<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is an owner
        if (Auth::check() && Auth::user()->role === 'owner') {
            return $next($request); // Allow the request to proceed
        }

        // If not an owner, abort with a 403 Forbidden response
        return abort(403);
    }
}
