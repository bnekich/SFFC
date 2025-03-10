<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CaseModelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin', [UserController::class, 'index'])->name('users')->middleware('permission:manage users');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/cases', [CaseModelController::class, 'index'])
//         ->middleware('permission:view cases');

//     Route::post('/cases', [CaseModelController::class, 'store'])
//         ->middleware('permission:create cases');

//     Route::resource('users', UserController::class)
//         ->middleware('permission:manage users');
// });
