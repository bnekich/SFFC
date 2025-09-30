<?php

use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\CaseModelController;
use App\Http\Controllers\OrganizationTypeController;
use App\Http\Controllers\RelationshipTypeController;
use App\Http\Controllers\ReminderTypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CaseNoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\CaseStatusController;
use App\Http\Controllers\NoteController;

Route::get('/2fa/challenge', [TwoFactorController::class, 'showChallenge'])->name('2fa.challenge');
Route::post('/2fa/challenge', [TwoFactorController::class, 'sendCode'])->name('2fa.challenge');
Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
Route::post('/2fa/send', [TwoFactorController::class, 'sendCode'])->name('2fa.send');

Route::get('/document', [DocumentController::class, 'index'])->name('document.index');
Route::get('/document/{document}/download', [DocumentController::class, 'download'])->name('document.download');

Route::get('/familySearch', [FamilyController::class, 'search'])->middleware('auth');
Route::get('/orgSearch', [OrganizationController::class, 'search'])->middleware('auth');
Route::get('/peopleSearch', [PersonController::class, 'search'])->middleware('auth');
Route::get('api/noteables', [NoteController::class, 'apiNoteables'])->middleware(['auth'])->name('note.apiNoteables');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('organization-types', OrganizationTypeController::class);
    Route::resource('relationship-types', RelationshipTypeController::class);
    Route::resource('reminder-types', ReminderTypeController::class);
});

Route::resource('case', CaseModelController::class)->middleware('auth');
Route::resource('intake', IntakeController::class)->middleware('auth');
Route::resource('person', PersonController::class)->middleware('auth');
Route::resource('family', FamilyController::class)->middleware('auth');
Route::resource('organization', OrganizationController::class)->middleware('auth');
Route::resource('course', CourseController::class)->middleware('auth');
Route::resource('casenote', CaseNoteController::class)->middleware('auth');
Route::resource('tag', TagController::class)->middleware('auth');
Route::resource('case-statuses', CaseStatusController::class)->middleware('auth');
Route::resource('note', NoteController::class)->middleware('auth');



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/settings', [HomeController::class, 'settings'])->name('dashboard.settings');
Route::post('/dashboard/settings', [HomeController::class, 'updateSettings']);

/*
 * We comment this out because it registers default authentication routes pointing to LoginController.
 * Your custom 2FA logic, however, is located in AuthController, so we need to define the routes manually.
 */
// Auth::routes();

Route::get('login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes - Add these back to restore functionality
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'update'])->name('password.update');
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
