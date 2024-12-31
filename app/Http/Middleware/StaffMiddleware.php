<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(FacadesAuth::user()->role == 'therapist'){
            return $next($request);
        }   

        // if(FacadesAuth::user()->role == 'owner'){
        //     return $next($request);
        // }   

        // if(FacadesAuth::user()->role == 'patient'){
        //     return $next($request);
        // }   


        return abort(403);
    }
}