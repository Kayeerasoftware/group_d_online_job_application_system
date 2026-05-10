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
    Schema::create('saved_jobs', function (Blueprint $table) {
        $table->id();

        // Job seeker (user)
        $table->foreignId('job_seeker_id')
            ->constrained('users')
            ->onDelete('cascade');

        // Job reference
        $table->foreignId('job_id')
            ->constrained('job_postings')
            ->onDelete('cascade');

        $table->timestamps();

        // Prevent duplicate saves
        $table->unique(['job_seeker_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_jobs');
    }
};
