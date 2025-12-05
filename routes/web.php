<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;

Route::view('/', 'welcome');

// Auth (Breeze / Volt)
require __DIR__ . '/auth.php';

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Rutas protegidas
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PERFIL (Volt)
    Route::get('/perfil', function () {
        return view('profile');
    })->name('profile');

    // MATRÍCULAS
    Route::prefix('matriculas')->group(function () {

        Route::get('/', [EnrollmentController::class, 'index'])
            ->name('enrollments.index');

        // Alumno NUEVO
        Route::get('/nueva', [EnrollmentController::class, 'create'])
            ->name('enrollments.create');

        // Alumno ANTIGUO (editar matrícula existente)
        Route::get('/{enrollment}/editar', [EnrollmentController::class, 'edit'])
            ->name('enrollments.edit');

        // PDF de matrícula
        Route::get('/{enrollment}/pdf', [EnrollmentController::class, 'pdf'])
            ->name('enrollments.pdf');
    });
});
