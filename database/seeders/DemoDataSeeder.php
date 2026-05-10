<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            EmployerProfileSeeder::class,
            JobSeekerProfileSeeder::class,
            IntegrationSettingSeeder::class,
            JobSeeder::class,
            ApplicationSeeder::class,
            SavedJobSeeder::class,
            NotificationSeeder::class,
            RegulatoryReportSeeder::class,
            AuditLogSeeder::class,
        ]);
    }
}
