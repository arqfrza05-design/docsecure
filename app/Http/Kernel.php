<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array<string, class-string|array<int, class-string>>
     */
    protected $routeMiddleware = [
        // ...existing middleware...
        'admin' => \App\Http\Middleware\IsAdmin::class,
    ];
}
