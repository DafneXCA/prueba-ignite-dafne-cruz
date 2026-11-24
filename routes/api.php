<?php

use App\Http\Controllers\ReaderController;
use App\Http\Middleware\RequireSsoForProtectedTitle;
use Illuminate\Support\Facades\Route;

Route::get('/reader/{title}', [ReaderController::class, 'show'])
    ->middleware(RequireSsoForProtectedTitle::class);
