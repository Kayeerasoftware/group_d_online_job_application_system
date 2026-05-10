<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('applications', function (Blueprint $table) {
        $table->id();

        // 🔗 Job reference
        $table->foreignId('job_id')
            ->constrained('job_postings')
            ->onDelete('cascade');

        // 🔗 Job seeker reference (user)
        $table->foreignId('job_seeker_id')
            ->constrained('users')
            ->onDelete('cascade');

        // Application data
        $table->text('cover_letter');
        $table->string('cv_path');

        // Application status flow
        $table->enum('status', [
            'pending',
            'reviewed',
            'shortlisted',
            'rejected',
            'hired'
        ])->default('pending');

        $table->date('applied_date');

        $table->text('employer_notes')->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
