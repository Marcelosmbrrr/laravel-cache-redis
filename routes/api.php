<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    UserController,
};

Route::get('/cache', [UserController::class, 'indexCache']);
Route::get('/no-cache', [UserController::class, 'indexNoCache']);

Route::apiResource('/users', UserController::class)->except('index');