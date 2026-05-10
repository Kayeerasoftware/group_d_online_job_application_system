<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
<<<<<<< HEAD
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table) {
=======
    public function up(): void
    {
        Schema::create('cache', function (Blueprint $table): void {
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

<<<<<<< HEAD
        Schema::create('cache_locks', function (Blueprint $table) {
=======
        Schema::create('cache_locks', function (Blueprint $table): void {
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

<<<<<<< HEAD
    /**
     * Reverse the migrations.
     */
=======
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
