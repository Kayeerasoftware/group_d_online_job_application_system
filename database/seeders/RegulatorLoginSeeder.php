<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegulatorLoginSeeder extends Seeder
{
    public function run(): void
    {
        $regulators = User::where('role', 'regulator')->get();

        if ($regulators->isEmpty()) {
            $this->command->info('No regulators found. Creating a test regulator...');
            $regulator = User::create([
                'name' => 'System Regulator',
                'email' => 'regulator@example.com',
                'password' => bcrypt('password123'),
                'role' => 'regulator',
                'is_active' => true,
            ]);
            $regulators = collect([$regulator]);
        }

        foreach ($regulators as $regulator) {
            for ($i = 0; $i < 5; $i++) {
                DB::table('regulator_logins')->insert([
                    'user_id' => $regulator->id,
                    'ip_address' => '192.168.' . rand(0, 255) . '.' . rand(1, 254),
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                    'login_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                    'logout_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23))->addHours(rand(1, 8)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Regulator login records seeded successfully!');
    }
}
