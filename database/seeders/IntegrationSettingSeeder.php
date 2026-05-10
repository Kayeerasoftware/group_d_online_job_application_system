<?php

namespace Database\Seeders;

use App\Models\IntegrationSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class IntegrationSettingSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin@example.com')->first();

        IntegrationSetting::query()->updateOrCreate(
            ['channel' => 'email'],
            [
                'provider' => 'mailgun',
                'api_key' => 'demo-mailgun-key',
                'api_secret' => 'demo-mailgun-secret',
                'from_name' => 'Online Job Application System',
                'from_address' => 'no-reply@example.com',
                'enabled' => true,
                'notes' => 'Demo email provider used for exam presentation.',
                'updated_by' => $admin?->id,
            ]
        );

        IntegrationSetting::query()->updateOrCreate(
            ['channel' => 'sms'],
            [
                'provider' => 'twilio',
                'api_key' => 'demo-twilio-key',
                'api_secret' => 'demo-twilio-secret',
                'sender_id' => 'OJASYS',
                'enabled' => true,
                'notes' => 'Demo SMS provider used for exam presentation.',
                'updated_by' => $admin?->id,
            ]
        );
    }
}
