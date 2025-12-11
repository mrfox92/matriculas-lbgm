<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;

Route::view('/', 'welcome');

// Breeze / Volt Auth
require __DIR__ . '/auth.php';

// LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


// =============================================
// RUTAS PROTEGIDAS (auth + active)
// =============================================
Route::middleware(['auth', 'active'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // PERFIL
    Route::get('/perfil', fn() => view('profile'))
        ->name('profile');


    // =============================================
    // MATRÍCULAS
    // =============================================
    Route::prefix('matriculas')->group(function () {

        Route::get('/', [EnrollmentController::class, 'index'])
            ->name('enrollments.index');

        Route::get('/nueva', [EnrollmentController::class, 'create'])
            ->name('enrollments.create');

        Route::get('/{enrollment}/editar', [EnrollmentController::class, 'edit'])
            ->name('enrollments.edit');

        Route::get('/{enrollment}/pdf', [EnrollmentController::class, 'pdf'])
            ->name('enrollments.pdf');
    });


    // =============================================
    // ADMINISTRACIÓN DE USUARIOS (solo admin)
    // =============================================
    Route::middleware('role:admin')
        ->prefix('usuarios')
        ->group(function () {

            Route::get('/', [UserController::class, 'index'])
                ->name('users.index');

            Route::get('/digitadores/nuevo', [UserController::class, 'createDigitador'])
                ->name('users.digitadores.create');

            Route::get('/{user}/editar', [UserController::class, 'edit'])
                ->name('users.edit');
        });
});
