<?php

use App\Http\Controllers\Faculty;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', Admin\DashboardController::class . '@index')->name('dashboard');
    
    Route::resource('departments', Admin\DepartmentController::class);
    Route::resource('faculty', Admin\FacultyController::class);
    Route::resource('courses', Admin\CourseController::class);
    Route::resource('students', Admin\StudentController::class, ['only' => ['index', 'show', 'destroy']]);
    // admin notice management
    Route::get('notices/pending', Admin\NoticeController::class . '@pending')->name('notices.pending');
    Route::post('notices/{notice}/approve', Admin\NoticeController::class . '@approve')->name('notices.approve');
    Route::resource('notices', Admin\NoticeController::class, ['only' => ['index', 'destroy']]);
});

// Student routes
Route::middleware(['auth', 'verified', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', Student\DashboardController::class . '@index')->name('dashboard');
    
    Route::resource('courses', Student\CourseController::class, ['only' => ['index', 'show']]);
    Route::get('enrolled', Student\CourseController::class . '@enrolled')->name('courses.enrolled');
    
    Route::post('enroll/{course}', Student\EnrollmentController::class . '@store')->name('enroll');
    Route::delete('unenroll/{course}', Student\EnrollmentController::class . '@destroy')->name('unenroll');
});

// Faculty routes
Route::middleware(['auth', 'verified', 'faculty'])->prefix('faculty')->name('faculty.')->group(function () {
    Route::get('/', Faculty\DashboardController::class . '@index')->name('dashboard');
    Route::resource('courses', Faculty\CourseController::class, ['only' => ['index', 'show']]);
    Route::resource('notices', Faculty\NoticeController::class);
});

// Default authenticated dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('status', 'Logged in as admin.');
        } elseif ($user->isFaculty()) {
            return redirect()->route('faculty.dashboard')->with('status', 'Logged in as faculty member.');
        }
        return redirect()->route('student.dashboard')->with('status', 'Logged in as student.');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
