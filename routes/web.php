<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', [AuthController::class, 'showLoginForm']) ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm']) ->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']) ->name('logout');

Route::get('/jobs', [JobController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'isAdmin'])->name('admin');

// Route::get('admin/jobs', function () {
//     return view('admin.jobs');
// })->middleware(['auth', 'isAdmin'])->name('admin.jobs');


Route::middleware(['auth', 'isAdmin'])->prefix('admin')
->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');
    Route::get('applications/{jobId}', [ApplicationController::class, 'index'])->name('applications.index');
    Route::put('applications/{id}', [ApplicationController::class, 'update'])->name('applications.update');
});

Route::resource('jobs', JobController::class);
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('apply.store')->middleware('auth');
Route::get('/jobs/{job}/applicants',[ApplicationController::class,'index'])->name('application.index')->middleware('isAdmin');
Route::resource('jobs', JobController::class)->middleware(['auth','isAdmin'])->except(['index', 'show']);
Route::resource('jobs', JobController::class)->middleware(['auth'])->only(['index','show']);
Route::resource('applications', ApplicationController::class)->middleware(['auth'])->only(['index', 'show']);

Route::get('/applications/export/{jobId}', [ApplicationController::class, 'export'])->name('applications.export')->middleware('isAdmin');


Route::get('/applications/{id}/download-cv', [ApplicationController::class, 'downloadCv'])->name('applications.download-cv')->middleware('isAdmin');


Route::post('/jobs/import', [JobController::class, 'import'])->name('jobs.import')->middleware('isAdmin');
Route::get('/jobs/import/template', [JobController::class, 'downloadTemplate'])->name('jobs.import.template')->middleware('isAdmin');


Route::get('/user', [JobController::class, 'index'])->middleware(['auth', 'isUser'])->name('user');