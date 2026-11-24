<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // No hay servicios externos en esta prueba aislada.
    }

    public function boot(): void
    {
        // No hay configuración adicional.
    }
}
