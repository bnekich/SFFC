<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\CaseModelController;
use App\Http\Controllers\OrganizationTypeController;
use App\Http\Controllers\PersonTypeController;
use App\Http\Controllers\RelationshipTypeController;
use App\Http\Controllers\ReminderTypeController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('organization-types', OrganizationTypeController::class);
    Route::resource('person-types', PersonTypeController::class);
    Route::resource('relationship-types', RelationshipTypeController::class);
    Route::resource('reminder-types', ReminderTypeController::class);
});

Route::resource('cases', CaseModelController::class)->middleware('auth');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::get('/admin', [UserController::class, 'index'])->name('users')->middleware(['auth', 'permission:manage users']);
Route::resource('users', UserController::class)->middleware(['auth', 'permission:manage users']);

Route::post('/password/reset', [PasswordResetController::class, 'update'])->name('password.update')->middleware('auth');
Route::get('/password/reset', [PasswordResetController::class, 'show'])->name('password.reset')->middleware('auth');

Route::prefix('admin')->middleware(['auth', 'permission:manage roles|manage permissions'])->group(function () {
    // Roles CRUD
    Route::get('roles', [RolePermissionController::class, 'indexRoles'])->name('roles.index');
    Route::get('roles/create', [RolePermissionController::class, 'createRole'])->name('roles.create');
    Route::post('roles', [RolePermissionController::class, 'storeRole'])->name('roles.store');
    Route::get('roles/{role}/edit', [RolePermissionController::class, 'editRole'])->name('roles.edit');
    Route::put('roles/{role}', [RolePermissionController::class, 'updateRole'])->name('roles.update');
    Route::delete('roles/{role}', [RolePermissionController::class, 'destroyRole'])->name('roles.destroy');

    // Permissions CRUD
    Route::get('permissions', [RolePermissionController::class, 'indexPermissions'])->name('permissions.index');
    Route::get('permissions/create', [RolePermissionController::class, 'createPermission'])->name('permissions.create');
    Route::post('permissions', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::get('permissions/{permission}/edit', [RolePermissionController::class, 'editPermission'])->name('permissions.edit');
    Route::put('permissions/{permission}', [RolePermissionController::class, 'updatePermission'])->name('permissions.update');
    Route::delete('permissions/{permission}', [RolePermissionController::class, 'destroyPermission'])->name('permissions.destroy');
});

Route::resource('audit-logs', AuditLogController::class)->middleware('auth');
