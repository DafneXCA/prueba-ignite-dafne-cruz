<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // La prueba usa el grupo API estándar y route model binding de Laravel.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Se conserva el manejo estándar de excepciones de Laravel.
    })->create();
