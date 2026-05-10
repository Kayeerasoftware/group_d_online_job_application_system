<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employer_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('company_website')->nullable();
            $table->string('industry')->nullable();
            $table->string('company_logo')->nullable();

            $table->string('tax_id')->nullable();
            $table->boolean('verified_by_admin')->default(false);
            $table->date('verification_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employer_profiles');
    }
};