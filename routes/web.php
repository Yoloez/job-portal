<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

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

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'isAdmin'])->name('admin');

Route::get('admin/jobs', function () {
    return view('admin.jobs');
})->middleware(['auth', 'isAdmin'])->name('admin.jobs');

Route::get('/user', function () {
    return view('user.profile');
})->middleware(['auth', 'isUser'])->name('user');