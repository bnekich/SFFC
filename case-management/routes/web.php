<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
//use App\Http\Controllers\CaseModelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Auth\PasswordResetController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin', [UserController::class, 'index'])->name('users')->middleware(['auth', 'permission:manage users']);
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::resource('users', UserController::class)->except(['index'])->middleware(['auth', 'permission:manage users']);

Route::post('/password/reset', [PasswordResetController::class, 'update'])->name('password.reset.update')->middleware('auth');
Route::get('/password/reset', [PasswordResetController::class, 'show'])->name('password.reset')->middleware('auth');

// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::get('/password/reset', [PasswordResetController::class, 'show'])->name('password.reset');
//     Route::post('/password/reset', [PasswordResetController::class, 'update'])->name('password.reset.update');
// });

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

//Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit.user')->middleware('permission:manage users');
// Route::middleware(['auth'])->group(function () {
//     Route::get('/cases', [CaseModelController::class, 'index'])
//         ->middleware('permission:view cases');

//     Route::post('/cases', [CaseModelController::class, 'store'])
//         ->middleware('permission:create cases');

//     Route::resource('users', UserController::class)
//         ->middleware('permission:manage users');
// });
