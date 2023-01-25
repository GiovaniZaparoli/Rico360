<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\CallController;
use App\Http\Controllers\API\TwilioController;

Route::post('register', [RegisterController::class, 'register'] );
Route::post('login', [RegisterController::class, 'login'] );

Route::middleware('auth:api')->group(function () {
    Route::get('calls', [CallController::class, 'index']);
    Route::get('/user/me', [UserController::class, 'me']);
    Route::get('/twilio/token', [TwilioController::class, 'token']);
});

Route::post('/twilio/voice', [TwilioController::class, 'voice']);
Route::post('/twilio/callback', [TwilioController::class, 'callback']);
Route::get('/users', [UserController::class, 'index']);
