<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware(['isAdmin'])->group(function () {
        Route::resource('applications', ApplicationController::class)->only('index');
        Route::get('/applications/export', [ApplicationController::class, 'export']);
        Route::get('/applications/{application}/download-cv', [ApplicationController::class, 'downloadCV']);
        Route::patch('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
        Route::patch('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');

        Route::resource('vacancies', VacancyController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
        Route::post('/vacancies/import', [VacancyController::class, 'import'])->name('vacancies.import');
        Route::get('/vacancies/template/export', [VacancyController::class, 'template'])->name('vacancies.template');
        Route::get('/vacancies/{vacancy}/applicants/export', [VacancyController::class, 'exportApplicants'])->name('vacancies.export');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('vacancies', VacancyController::class)->only('index', 'show');
    Route::resource('applications', ApplicationController::class)->only(['create', 'store']);
});

require __DIR__.'/auth.php';



Route::get('/admin/jobs', [JobController::class, 'dashboard'])->middleware('isAdmin');

Route::get('/mail', [SendMailController::class, 'sendMail']);