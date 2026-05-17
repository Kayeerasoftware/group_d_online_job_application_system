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
        Schema::table('notifications', function (Blueprint $table): void {
            if (!Schema::hasColumn('notifications', 'read_at')) {
                $table->timestamp('read_at')->nullable();
            }
            if (!Schema::hasColumn('notifications', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('notifications', 'action_url')) {
                $table->string('action_url')->nullable();
            }
            if (!Schema::hasColumn('notifications', 'last_attempt_at')) {
                $table->timestamp('last_attempt_at')->nullable();
            }
            if (!Schema::hasColumn('notifications', 'delivery_error')) {
                $table->text('delivery_error')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table): void {
            $table->dropColumn(['read_at', 'title', 'action_url', 'delivery_attempts', 'last_attempt_at', 'delivery_error']);
        });
    }
};
