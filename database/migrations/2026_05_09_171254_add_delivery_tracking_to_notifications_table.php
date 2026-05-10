<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table): void {
            $table->unsignedTinyInteger('delivery_attempts')->default(0)->after('delivery_status');
            $table->timestamp('last_attempt_at')->nullable()->after('delivery_attempts');
            $table->text('delivery_error')->nullable()->after('last_attempt_at');
        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table): void {
            $table->dropColumn(['delivery_attempts', 'last_attempt_at', 'delivery_error']);
        });
    }
};
