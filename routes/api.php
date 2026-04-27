<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/appointments', [\App\Http\Controllers\Api\AppointmentController::class, 'index']);
Route::post('/appointments', [\App\Http\Controllers\Api\AppointmentController::class, 'store']);
