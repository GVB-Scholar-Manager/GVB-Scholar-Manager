<?php

use Illuminate\Support\Facades\Route;
use App\Http\Api\Auth\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
