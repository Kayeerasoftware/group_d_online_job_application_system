<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Seeker\DashboardController as SeekerDashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\JobSeekerProfileController;
use App\Http\Controllers\EmployerProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ComplianceReportController;
use App\Http\Controllers\Admin\SystemController as AdminSystemController;
use App\Http\Controllers\Admin\JobModerationController as AdminJobModerationController;
use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'create'])->middleware(['auth', 'employer'])->name('jobs.create');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware(['auth', 'employer'])->name('jobs.edit');
Route::post('/jobs', [JobController::class, 'store'])->middleware(['auth', 'employer'])->name('jobs.store');
Route::put('/jobs/{job}', [JobController::class, 'update'])->middleware(['auth', 'employer'])->name('jobs.update');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware(['auth', 'employer'])->name('jobs.destroy');

Route::get('/applications', [ApplicationController::class, 'index'])->middleware('auth')->name('applications.index');
Route::get('/applications/create', [ApplicationController::class, 'create'])->middleware(['auth', 'seeker'])->name('applications.create');
Route::get('/applications/{application}', [ApplicationController::class, 'show'])->middleware('auth')->name('applications.show');
Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->middleware('auth')->name('applications.edit');
Route::post('/applications', [ApplicationController::class, 'store'])->middleware(['auth', 'seeker'])->name('applications.store');
Route::put('/applications/{application}', [ApplicationController::class, 'update'])->middleware('auth')->name('applications.update');
Route::patch('/applications/{application}/status', [ApplicationController::class, 'update'])
    ->middleware('auth')
    ->name('applications.status');
Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->middleware('auth')->name('applications.destroy');

Route::prefix('seeker')->middleware(['auth', 'seeker'])->name('seeker.')->group(function (): void {
    Route::get('/dashboard', [SeekerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [JobSeekerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [JobSeekerProfileController::class, 'update'])->name('profile.update');
    Route::get('/saved-jobs', [SavedJobController::class, 'index'])->name('saved-jobs.index');
    Route::post('/saved-jobs/{job}', [SavedJobController::class, 'store'])->name('saved-jobs.store');
    Route::delete('/saved-jobs/{savedJob}', [SavedJobController::class, 'destroy'])->name('saved-jobs.destroy');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
});

Route::prefix('employer')->middleware(['auth', 'employer'])->name('employer.')->group(function (): void {
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [EmployerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [EmployerProfileController::class, 'update'])->name('profile.update');
    Route::get('/jobs/{job}/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/jobs/{job}/applications/export', [ApplicationController::class, 'export'])->name('applications.export');
    Route::patch('/applications/{application}/status', [ApplicationController::class, 'update'])->name('applications.status');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function (): void {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/system', [AdminSystemController::class, 'index'])->name('system.index');
    Route::put('/system/{integrationSetting}', [AdminSystemController::class, 'update'])->name('system.update');
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserManagementController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/suspend', [UserManagementController::class, 'suspend'])->name('users.suspend');
    Route::patch('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.role');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
    Route::post('/jobs/{job}/flag', [AdminJobModerationController::class, 'flag'])->name('jobs.flag');
    Route::get('/reports', [ComplianceReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ComplianceReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ComplianceReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{regulatoryReport}', [ComplianceReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{regulatoryReport}/download', [ComplianceReportController::class, 'download'])->name('reports.download');
    Route::patch('/reports/{regulatoryReport}/submit', [ComplianceReportController::class, 'submit'])->name('reports.submit');
});
