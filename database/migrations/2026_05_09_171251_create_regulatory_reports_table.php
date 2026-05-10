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
        Schema::create('regulatory_reports', function (Blueprint $table): void {
            $table->id();
            $table->string('report_type');
            $table->foreignId('generated_by')->constrained('users')->cascadeOnDelete();
            $table->date('date_range_start');
            $table->date('date_range_end');
            $table->json('aggregated_data');
            $table->string('status')->default('draft');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regulatory_reports');
    }
};
