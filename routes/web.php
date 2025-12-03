<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;

Route::view('/', 'welcome');

// Authentication routes
require __DIR__.'/auth.php';

// Routes with authentication
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PROFILE (VOLT)
    Route::get('/perfil', function () {
        return view('profile');
    })->name('profile');

    // MATRÍCULAS
    Route::get('/matriculas', [EnrollmentController::class, 'index'])
        ->name('enrollments.index');

    Route::get('/matriculas/nueva', [EnrollmentController::class, 'create'])
        ->name('enrollments.create');

    Route::get('/matriculas/{enrollment}/editar', [EnrollmentController::class, 'edit'])
        ->name('enrollments.edit');

    Route::get('/matriculas/{enrollment}/pdf', [EnrollmentController::class, 'pdf'])
        ->name('enrollments.pdf');
});
