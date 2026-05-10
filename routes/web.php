<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SupervisionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pidana', [HomeController::class, 'pidanaList'])->name('pidana.list');
Route::get('/pidana/{user}', [HomeController::class, 'pidanaShow'])->name('pidana.show');
Route::get('/regulations', function () {
    return view('regulations');
})->name('regulations');

Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
    Route::get('/absences/create', [AbsenceController::class, 'create'])->name('absences.create');
    Route::post('/absences', [AbsenceController::class, 'store'])->name('absences.store');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminController::class, 'index'])->name('index');
        Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/users/{user}', [AdminController::class, 'update'])->name('update');
        Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('destroy');

        // PKS-03 Supervision
        Route::get('/users/{user}/supervisions', [SupervisionController::class, 'index'])->name('supervisions.index');
        Route::post('/users/{user}/supervisions', [SupervisionController::class, 'store'])->name('supervisions.store');
        Route::put('/supervisions/{supervision}', [SupervisionController::class, 'update'])->name('supervisions.update');
        Route::delete('/supervisions/{supervision}', [SupervisionController::class, 'destroy'])->name('supervisions.destroy');

        // Complaints Management
        Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
        Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
    });
});
