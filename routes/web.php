<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\Admin\Pks03AssessmentController;
use App\Http\Controllers\Admin\PlacementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SupervisorComplaintController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfExportController;
use App\Http\Controllers\SupervisionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pidana', [HomeController::class, 'pidanaList'])->name('pidana.list');
Route::get('/pidana/{user}', [HomeController::class, 'pidanaShow'])->name('pidana.show');
Route::get('/regulations', function () {
    return view('regulations');
})->name('regulations');

Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create')->middleware('throttle:60,1');
Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store')->middleware('throttle:30,1');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/absences', [AbsenceController::class, 'index'])->name('absences.index');
    Route::get('/absences/create', [AbsenceController::class, 'create'])->name('absences.create');
    Route::post('/absences', [AbsenceController::class, 'store'])->name('absences.store')->middleware('throttle:3,1440');

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

        // PKS-03 Assessment (Halaman 1)
        Route::get('/users/{user}/pks03-assessment', [Pks03AssessmentController::class, 'show'])->name('pks03-assessment.show');
        Route::post('/users/{user}/pks03-assessment', [Pks03AssessmentController::class, 'store'])->name('pks03-assessment.store');
        Route::put('/users/{user}/pks03-assessment', [Pks03AssessmentController::class, 'update'])->name('pks03-assessment.update');

        // Complaints Management
        Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
        Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');

        // Supervisor Complaints
        Route::get('/supervisor-complaints', [SupervisorComplaintController::class, 'index'])->name('supervisor-complaints.index');
        Route::get('/supervisor-complaints/create', [SupervisorComplaintController::class, 'create'])->name('supervisor-complaints.create');
        Route::post('/supervisor-complaints', [SupervisorComplaintController::class, 'store'])->name('supervisor-complaints.store');
        Route::delete('/supervisor-complaints/{supervisorComplaint}', [SupervisorComplaintController::class, 'destroy'])->name('supervisor-complaints.destroy');

        // PDF Exports
        Route::get('/users/{user}/pks02', [PdfExportController::class, 'pks02'])->name('export.pks02');
        Route::get('/users/{user}/pks03', [PdfExportController::class, 'pks03'])->name('export.pks03');
        Route::get('/users/{user}/pks03-assessment.pdf', [Pks03AssessmentController::class, 'pdf'])->name('pks03-assessment.pdf');

        // Reports
        Route::get('/users/{user}/report/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
        Route::get('/users/{user}/report/monthly/pdf', [PdfExportController::class, 'monthlyAbsence'])->name('export.monthly');

        // Placements
        Route::resource('placements', PlacementController::class);
    });
});
