<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_seeker_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('location')->nullable();

            $table->string('education_level')->nullable();
            $table->integer('years_experience')->default(0);

            $table->text('skills')->nullable();
            $table->string('resume_path')->nullable();

            $table->json('notification_preferences')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_seeker_profiles');
    }
};