<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\Student;
use App\Http\Controllers\Api\Faculty;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // Public routes
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);

        // Admin API routes
        Route::middleware('admin')->prefix('admin')->group(function () {
            Route::apiResource('departments', Admin\DepartmentController::class);
            Route::apiResource('faculty', Admin\FacultyController::class, ['only' => ['index', 'show']]);
            Route::apiResource('courses', Admin\CourseController::class, ['only' => ['index', 'show']]);
            Route::apiResource('students', Admin\StudentController::class, ['only' => ['index', 'show']]);
            Route::apiResource('enrollments', Admin\EnrollmentController::class, ['only' => ['index', 'show']]);
        });

        // Faculty API routes
        Route::middleware('faculty')->prefix('faculty')->group(function () {
            Route::apiResource('courses', Faculty\CourseController::class, ['only' => ['index', 'show']]);
        });
    });
});

