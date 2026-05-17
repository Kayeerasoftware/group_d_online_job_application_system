<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_seeker_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('job_seeker_profiles', 'job_title')) {
                $table->string('job_title')->nullable();
            }
            if (!Schema::hasColumn('job_seeker_profiles', 'bio')) {
                $table->text('bio')->nullable();
            }
            if (!Schema::hasColumn('job_seeker_profiles', 'cv_path')) {
                $table->string('cv_path')->nullable();
            }
            if (!Schema::hasColumn('job_seeker_profiles', 'experience_level')) {
                $table->string('experience_level')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('job_seeker_profiles', function (Blueprint $table) {
            $table->dropColumnIfExists('job_title');
            $table->dropColumnIfExists('bio');
            $table->dropColumnIfExists('cv_path');
            $table->dropColumnIfExists('experience_level');
        });
    }
};
