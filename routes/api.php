<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\CalendarEventController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoleController;

// Rutas públicas (No requieren token)
Route::post('/register', [AuthController::class, 'register']); //Registro
Route::post('/login', [AuthController::class, 'login']); // Login
// Rutas protegidas (Requieren token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Logout
    Route::get('/me', [AuthController::class, 'me']); // Obtener datosdel usuario autenticado

    // CRUD de cursos
    Route::get('/courses', [CourseController::class, 'index']); // Listar cursos
    Route::post('/courses', [CourseController::class, 'store']); // Crear un curso
    Route::get('/courses/{id}', [CourseController::class, 'show']); // Ver un curso
    Route::put('/courses/{id}', [CourseController::class, 'update']); // Actualizar un curso
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']); // Eliminar un curso

    // CRUD de asignaturas
    Route::get('/subjects', [SubjectController::class, 'index']);
    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::get('/subjects/{id}', [SubjectController::class, 'show']);
    Route::put('/subjects/{id}', [SubjectController::class, 'update']);
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);

    // CRUD de assignments
    Route::get('/assignments', [AssignmentController::class, 'index']);
    Route::post('/assignments', [AssignmentController::class, 'store']);
    Route::get('/assignments/{id}', [AssignmentController::class,'show']);
    Route::put('/assignments/{id}', [AssignmentController::class,'update']);
    Route::delete('/assignments/{id}', [AssignmentController::class,'destroy']);
    // CRUD de submissions
    Route::get('/submissions', [SubmissionController::class, 'index']);
    Route::post('/submissions', [SubmissionController::class, 'store']);
    Route::get('/submissions/{id}', [SubmissionController::class,'show']);
    Route::put('/submissions/{id}', [SubmissionController::class,'update']);

    // CRUD de eventos del calendario
    Route::get('/calendar', [CalendarEventController::class, 'index']);
    Route::post('/calendar', [CalendarEventController::class, 'store']);
    Route::get('/calendar/{id}', [CalendarEventController::class,'show']);
    Route::put('/calendar/{id}', [CalendarEventController::class,'update']);
    Route::delete('/calendar/{id}', [CalendarEventController::class,'destroy']);

    // Mensajería
    Route::get('/messages', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/messages/conversation/{userId}',
    [MessageController::class, 'conversation']);
    Route::put('/messages/{id}/read', [MessageController::class,'markAsRead']);
    Route::delete('/messages/{id}', [MessageController::class,'destroy']);

    // Roles
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::post('/users/{userId}/assign-role', [RoleController::class,'assignRole']);
    Route::post('/users/{userId}/remove-role', [RoleController::class,'removeRole']);
});
