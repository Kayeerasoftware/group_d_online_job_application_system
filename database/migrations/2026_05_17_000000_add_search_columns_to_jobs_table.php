<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table): void {
            if (!Schema::hasColumn('jobs', 'category')) {
                $table->string('category')->nullable()->after('job_type');
            }
            if (!Schema::hasColumn('jobs', 'level')) {
                $table->string('level')->nullable()->after('category');
            }
            if (!Schema::hasColumn('jobs', 'work_arrangement')) {
                $table->string('work_arrangement')->nullable()->after('level');
            }
            if (!Schema::hasColumn('jobs', 'views_count')) {
                $table->integer('views_count')->default(0)->after('work_arrangement');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table): void {
            $table->dropColumn(['category', 'level', 'work_arrangement', 'views_count']);
        });
    }
};
