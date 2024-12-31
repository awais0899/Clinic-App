<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
    ];

    protected $routeMiddleware = [
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        // Other middleware
    ];

    protected $middlewareGroups = [
        'web' => [
            // Other middlewares...
            \RealRashid\SweetAlert\ToSweetAlert::class, // Make sure it's in the right order
        ],
    ];  
}
