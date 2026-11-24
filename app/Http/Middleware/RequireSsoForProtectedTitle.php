<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequireSsoForProtectedTitle
{
    public function handle(Request $request, Closure $next): Response
    {
        /*
         * TODO: completa este middleware siguiendo el contrato del README.
         *
         * Pistas de Laravel:
         * - El parámetro {title} ya fue resuelto por route model binding.
         * - Puedes obtenerlo con $request->route('title').
         * - Sanctum expone el usuario con $request->user('sanctum').
         *
         * No modifiques el controlador, las rutas ni los modelos.
         */

        return $next($request);
    }
}
