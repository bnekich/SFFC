<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\CaseModelController;
use App\Http\Controllers\OrganizationTypeController;
use App\Http\Controllers\RelationshipTypeController;
use App\Http\Controllers\ReminderTypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\FamilyController;

Route::get('/search', [FamilyController::class, 'search'])->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('organization-types', OrganizationTypeController::class);
    Route::resource('relationship-types', RelationshipTypeController::class);
    Route::resource('reminder-types', ReminderTypeController::class);
});

Route::resource('cases', CaseModelController::class)->middleware('auth');

Route::resource('intake', IntakeController::class)->middleware('auth');

Route::resource('person', PersonController::class)->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/settings', [HomeController::class, 'settings'])->name('dashboard.settings');
Route::post('/dashboard/settings', [HomeController::class, 'updateSettings']);

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});


Route::post('/password/reset', [PasswordResetController::class, 'update'])->name('password.update')->middleware('auth');
Route::get('/password/reset', [PasswordResetController::class, 'show'])->name('password.reset')->middleware('auth');

Route::resource('roles', RoleController::class)->middleware(['auth', 'permission:roles-create|roles-update|roles-delete']);

Route::resource('permissions', PermissionController::class)->middleware(['auth', 'permission:permissions-create|permissions-update|permissions-delete']);

Route::resource('audit-logs', AuditLogController::class)->middleware(['auth', 'permission:auditLogs-view']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('can:users-view');

    Route::middleware('can:users-create')->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
    });

    Route::middleware('can:users-edit')->group(function () {
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    });

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('can:users-delete');
});
