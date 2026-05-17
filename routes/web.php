<?php

use App\Http\Controllers\Employer\AllEmployersController;
use App\Http\Controllers\Employer\ApplicationController as EmployerApplicationController;
use App\Http\Controllers\Employer\InterviewsController as EmployerInterviewsController;
use App\Http\Controllers\Employer\MessagesController as EmployerMessagesController;
use App\Http\Controllers\Employer\NotificationsController as EmployerNotificationsController;
use App\Http\Controllers\Employer\SettingsController as EmployerSettingsController;
use App\Http\Controllers\Employer\ProfileController as EmployerProfileController;
use App\Http\Controllers\Employer\BrowseJobsController as EmployerBrowseJobsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Seeker\DashboardController as SeekerDashboardController;
use App\Http\Controllers\Seeker\BrowseJobsController;
use App\Http\Controllers\Seeker\ApplicationsController;
use App\Http\Controllers\Seeker\ApplicationController;
use App\Http\Controllers\Seeker\SavedJobsController;
use App\Http\Controllers\Seeker\InterviewsController;
use App\Http\Controllers\Seeker\MessagesController;
use App\Http\Controllers\Seeker\ResumeController;
use App\Http\Controllers\Seeker\SettingsController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\JobSeekerProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ComplianceReportController;
use App\Http\Controllers\Admin\SystemController as AdminSystemController;
use App\Http\Controllers\Admin\JobModerationController as AdminJobModerationController;
use App\Http\Controllers\Admin\ApplicationManagementController as AdminApplicationManagementController;
use App\Http\Controllers\Admin\EmployerManagementController as AdminEmployerManagementController;
use App\Http\Controllers\Regulator\DashboardController as RegulatorDashboardController;
use App\Http\Controllers\Regulator\ComplianceController as RegulatorComplianceController;
use App\Http\Controllers\Regulator\SystemMonitoringController as RegulatorSystemMonitoringController;
use App\Http\Controllers\Regulator\ProfileController as RegulatorProfileController;
use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

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

Route::prefix('seeker')->middleware(['auth', 'seeker'])->name('seeker.')->group(function (): void {
    Route::get('/dashboard', [SeekerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [JobSeekerProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [JobSeekerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [JobSeekerProfileController::class, 'update'])->name('profile.update');
    Route::get('/browse-jobs', [BrowseJobsController::class, 'index'])->name('browse-jobs');
    Route::get('/browse-jobs/{job}', [BrowseJobsController::class, 'show'])->name('jobs.show');
    Route::get('/applications', [ApplicationsController::class, 'index'])->name('applications');
    Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    Route::get('/saved-jobs', [SavedJobsController::class, 'index'])->name('saved-jobs');
    Route::post('/saved-jobs/{job}', [SavedJobController::class, 'store'])->name('saved-jobs.store');
    Route::delete('/saved-jobs/{savedJob}', [SavedJobController::class, 'destroy'])->name('saved-jobs.destroy');
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
    Route::post('/resume', [ResumeController::class, 'store'])->name('resume.store');
    Route::get('/interviews', [InterviewsController::class, 'index'])->name('interviews');
    Route::get('/interviews/{application}', [InterviewsController::class, 'show'])->name('interviews.show');
    Route::post('/interviews/{application}/message', [InterviewsController::class, 'sendMessage'])->name('interviews.message');
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages');
    Route::get('/messages/search', [MessagesController::class, 'search'])->name('messages.search');
    Route::get('/messages/{user}', [MessagesController::class, 'getConversation'])->name('messages.conversation');
    Route::post('/messages/{user}', [MessagesController::class, 'sendMessage'])->name('messages.send');
    Route::patch('/messages/{message}/read', [MessagesController::class, 'markAsRead'])->name('messages.read');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::post('/settings/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::post('/settings/privacy', [SettingsController::class, 'updatePrivacy'])->name('settings.privacy');
    Route::post('/settings/appearance', [SettingsController::class, 'updateAppearance'])->name('settings.appearance');
    Route::post('/settings/two-factor/enable', [SettingsController::class, 'enableTwoFactor'])->name('settings.two-factor.enable');
    Route::post('/settings/two-factor/disable', [SettingsController::class, 'disableTwoFactor'])->name('settings.two-factor.disable');
});

Route::prefix('employer')->middleware(['auth', 'employer'])->name('employer.')->group(function (): void {
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/all-employers', [AllEmployersController::class, 'index'])->name('all-employers');
    Route::get('/browse-jobs', [EmployerBrowseJobsController::class, 'index'])->name('browse-jobs');
    Route::get('/profile', [EmployerProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [EmployerProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [EmployerProfileController::class, 'update'])->name('profile.update');
    Route::get('/applications', [EmployerApplicationController::class, 'index'])->name('applications');
    Route::get('/applications/{application}', [EmployerApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [EmployerApplicationController::class, 'update'])->name('applications.status');
    Route::get('/interviews', [EmployerInterviewsController::class, 'index'])->name('interviews');
    Route::get('/interviews/{application}', [EmployerInterviewsController::class, 'show'])->name('interviews.show');
    Route::post('/interviews/{application}/schedule', [EmployerInterviewsController::class, 'schedule'])->name('interviews.schedule');
    Route::post('/interviews/{application}/outcome', [EmployerInterviewsController::class, 'setOutcome'])->name('interviews.outcome');
    Route::get('/messages', [EmployerMessagesController::class, 'index'])->name('messages');
    Route::get('/messages/{user}', [EmployerMessagesController::class, 'getConversation'])->name('messages.conversation');
    Route::post('/messages/{user}', [EmployerMessagesController::class, 'sendMessage'])->name('messages.send');
    Route::patch('/messages/{message}/read', [EmployerMessagesController::class, 'markAsRead'])->name('messages.read');
    Route::get('/notifications', [EmployerNotificationsController::class, 'index'])->name('notifications');
    Route::post('/notifications/{notification}/read', [EmployerNotificationsController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [EmployerNotificationsController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{notification}', [EmployerNotificationsController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/settings', [EmployerSettingsController::class, 'index'])->name('settings');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function (): void {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/system', [AdminSystemController::class, 'index'])->name('system.index');
    Route::put('/system/{integrationSetting}', [AdminSystemController::class, 'update'])->name('system.update');
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserManagementController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/suspend', [UserManagementController::class, 'suspend'])->name('users.suspend');
    Route::patch('/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.role');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
    Route::get('/jobs', [AdminJobModerationController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [AdminJobModerationController::class, 'show'])->name('jobs.show');
    Route::post('/jobs/{job}/flag', [AdminJobModerationController::class, 'flag'])->name('jobs.flag');
    Route::post('/jobs/{job}/unflag', [AdminJobModerationController::class, 'unflag'])->name('jobs.unflag');
    Route::post('/jobs/{job}/approve', [AdminJobModerationController::class, 'approve'])->name('jobs.approve');
    Route::post('/jobs/{job}/reject', [AdminJobModerationController::class, 'reject'])->name('jobs.reject');
    Route::delete('/jobs/{job}', [AdminJobModerationController::class, 'delete'])->name('jobs.delete');
    Route::get('/applications', [AdminApplicationManagementController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [AdminApplicationManagementController::class, 'show'])->name('applications.show');
    Route::get('/applications/filter', [AdminApplicationManagementController::class, 'filter'])->name('applications.filter');
    Route::delete('/applications/{application}', [AdminApplicationManagementController::class, 'delete'])->name('applications.delete');
    Route::get('/employers', [AdminEmployerManagementController::class, 'index'])->name('employers.index');
    Route::get('/employers/{user}', [AdminEmployerManagementController::class, 'show'])->name('employers.show');
    Route::post('/employers/{user}/suspend', [AdminEmployerManagementController::class, 'suspend'])->name('employers.suspend');
    Route::post('/employers/{user}/activate', [AdminEmployerManagementController::class, 'activate'])->name('employers.activate');
    Route::delete('/employers/{user}', [AdminEmployerManagementController::class, 'delete'])->name('employers.delete');
    Route::get('/reports', [ComplianceReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ComplianceReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ComplianceReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{regulatoryReport}', [ComplianceReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{regulatoryReport}/download', [ComplianceReportController::class, 'download'])->name('reports.download');
    Route::patch('/reports/{regulatoryReport}/submit', [ComplianceReportController::class, 'submit'])->name('reports.submit');
});

Route::prefix('regulator')->middleware(['auth', 'regulator'])->name('regulator.')->group(function (): void {
    Route::get('/dashboard', [RegulatorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [RegulatorProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [RegulatorProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [RegulatorProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [RegulatorProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/compliance', [RegulatorComplianceController::class, 'index'])->name('compliance.index');
    Route::get('/compliance/filter', [RegulatorComplianceController::class, 'filter'])->name('compliance.filter');
    Route::get('/compliance/{regulatoryReport}', [RegulatorComplianceController::class, 'show'])->name('compliance.show');
    Route::get('/audit-logs', [RegulatorComplianceController::class, 'audit'])->name('audit-logs');
    Route::get('/system-monitoring', [RegulatorSystemMonitoringController::class, 'index'])->name('system-monitoring');
});
