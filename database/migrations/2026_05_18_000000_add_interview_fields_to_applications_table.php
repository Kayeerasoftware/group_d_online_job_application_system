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
        Schema::table('applications', function (Blueprint $table): void {
            $table->string('interview_type')->nullable()->comment('phone, video, in-person');
            $table->string('interviewer_name')->nullable();
            $table->string('interview_link')->nullable();
            $table->text('interview_notes')->nullable();
            $table->text('feedback')->nullable();
            $table->string('interview_outcome')->nullable()->comment('selected, rejected, pending');
            $table->timestamp('interview_completed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table): void {
            $table->dropColumn([
                'interview_type',
                'interviewer_name',
                'interview_link',
                'interview_notes',
                'feedback',
                'interview_outcome',
                'interview_completed_at',
            ]);
        });
    }
};
