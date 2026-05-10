<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'System Admin',
                'phone' => '0700000000',
                'role' => UserRole::Admin,
                'password' => 'password',
                'is_active' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'employer@example.com'],
            [
                'name' => 'Demo Employer',
                'phone' => '0700000001',
                'role' => UserRole::Employer,
                'password' => 'password',
                'is_active' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'employer@techforge.co.ug'],
            [
                'name' => 'TechForge HR',
                'phone' => '0700000011',
                'role' => UserRole::Employer,
                'password' => 'password',
                'is_active' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'seeker@example.com'],
            [
                'name' => 'Demo Seeker',
                'phone' => '0700000002',
                'role' => UserRole::Seeker,
                'password' => 'password',
                'is_active' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'seeker.amina@example.com'],
            [
                'name' => 'Amina Okello',
                'phone' => '0700000003',
                'role' => UserRole::Seeker,
                'password' => 'password',
                'is_active' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'seeker.brian@example.com'],
            [
                'name' => 'Brian Kato',
                'phone' => '0700000004',
                'role' => UserRole::Seeker,
                'password' => 'password',
                'is_active' => true,
            ]
        );
    }
}
