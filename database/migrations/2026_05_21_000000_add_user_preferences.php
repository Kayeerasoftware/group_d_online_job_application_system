<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            if (!Schema::hasColumn('users', 'two_factor_enabled')) {
                $table->boolean('two_factor_enabled')->default(false)->after('is_active');
            }
            if (!Schema::hasColumn('users', 'two_factor_secret')) {
                $table->string('two_factor_secret')->nullable()->after('two_factor_enabled');
            }
            if (!Schema::hasColumn('users', 'notifications_enabled')) {
                $table->boolean('notifications_enabled')->default(true)->after('two_factor_secret');
            }
            if (!Schema::hasColumn('users', 'job_recommendations')) {
                $table->boolean('job_recommendations')->default(true)->after('notifications_enabled');
            }
            if (!Schema::hasColumn('users', 'application_updates')) {
                $table->boolean('application_updates')->default(true)->after('job_recommendations');
            }
            if (!Schema::hasColumn('users', 'message_notifications')) {
                $table->boolean('message_notifications')->default(true)->after('application_updates');
            }
            if (!Schema::hasColumn('users', 'interview_reminders')) {
                $table->boolean('interview_reminders')->default(true)->after('message_notifications');
            }
            if (!Schema::hasColumn('users', 'profile_visible')) {
                $table->boolean('profile_visible')->default(true)->after('interview_reminders');
            }
            if (!Schema::hasColumn('users', 'show_email')) {
                $table->boolean('show_email')->default(false)->after('profile_visible');
            }
            if (!Schema::hasColumn('users', 'show_phone')) {
                $table->boolean('show_phone')->default(false)->after('show_email');
            }
            if (!Schema::hasColumn('users', 'theme')) {
                $table->string('theme')->default('light')->after('show_phone');
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('theme');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $columns = [
                'two_factor_enabled',
                'two_factor_secret',
                'notifications_enabled',
                'job_recommendations',
                'application_updates',
                'message_notifications',
                'interview_reminders',
                'profile_visible',
                'show_email',
                'show_phone',
                'theme',
                'last_login_at',
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
