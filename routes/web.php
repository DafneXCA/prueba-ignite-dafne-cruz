<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => response()->json([
    'name' => 'Prueba técnica Winkel',
    'status' => 'ok',
]));
