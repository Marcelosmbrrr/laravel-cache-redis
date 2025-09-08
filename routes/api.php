<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    UserController,
};

Route::apiResource('/users', UserController::class)->except('index');
Route::get('/cache', [UserController::class, 'indexCache']);
Route::get('/no-cache', [UserController::class, 'indexNoCache']);
Route::post('/dispatch-job', [UserController::class, 'dispatchJob']);
Route::post('/dispatch-delayed-job', [UserController::class, 'dispatchDelayedJob']);