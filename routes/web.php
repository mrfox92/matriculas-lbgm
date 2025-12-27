<?php

use App\Http\Controllers\PanelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PanelPdfController;

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

        Route::get('/nuevos', function () {
            return view('enrollments.new.index');
        })->name('enrollments.new.index');

        Route::get('/antiguos', [EnrollmentController::class, 'returning'])
            ->name('enrollments.returning.index');

        Route::get('/{enrollment}/editar', [EnrollmentController::class, 'edit'])
            ->name('enrollments.edit');

        Route::get('/{enrollment}/pdf', [EnrollmentController::class, 'pdf'])
            ->name('enrollments.pdf'); // debug

        Route::get('/{enrollment}/pdf/ver', [EnrollmentController::class, 'pdfView'])
            ->name('enrollments.pdf.view');

        Route::get('/{enrollment}/pdf/descargar', [EnrollmentController::class, 'pdfDownload'])
            ->name('enrollments.pdf.download');
    });


    // =============================================
    // ADMINISTRACIÓN DE USUARIOS (solo admin)
    // =============================================
    Route::middleware('role:admin')
        ->prefix('usuarios')
        ->group(function () {

            Route::get('/', [UserController::class, 'index'])
                ->name('users.index');

            Route::get('/crear', [UserController::class, 'create'])
                ->name('users.create');

            Route::get('/{user}/editar', [UserController::class, 'edit'])
                ->name('users.edit');

            Route::patch('/{user}/toggle', [UserController::class, 'toggle'])
                ->name('users.toggle');

            Route::delete('/{user}', [UserController::class, 'destroy'])
                ->name('users.destroy');


        });

    // =============================================
    // PANEL ADMINISTRATIVO
    // =============================================
    Route::middleware('role:admin')
        ->prefix('panel')
        ->group(function () {

            Route::get('/', [PanelController::class, 'index'])
                ->name('panel.index');
         
            Route::get('/export/pdf', [PanelPdfController::class, 'enrollments'])
                ->name('panel.export.pdf');
        });

});
