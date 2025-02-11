<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Rutas públicas (No requieren token)
Route::post('/register', [AuthController::class, 'register']); //Registro
Route::post('/login', [AuthController::class, 'login']); // Login
// Rutas protegidas (Requieren token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Logout
    Route::get('/me', [AuthController::class, 'me']); // Obtener datosdel usuario autenticado
});
