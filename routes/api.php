<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Importamos tus controladores aquí arriba
use App\Http\Controllers\Api\DuenoController;
use App\Http\Controllers\Api\AnimalController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::apiResource('duenos', DuenoController::class);
Route::apiResource('animales', AnimalController::class);