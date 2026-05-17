<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\EmployerProfile;

// Get the latest employer profile
$profile = EmployerProfile::latest()->first();

if ($profile) {
    echo "Profile ID: " . $profile->id . "\n";
    echo "User ID: " . $profile->user_id . "\n";
    echo "Company Name: " . $profile->company_name . "\n";
    echo "Raw Logo Value: " . $profile->getRawOriginal('company_logo') . "\n";
    echo "Accessor Logo Value: " . $profile->company_logo . "\n";
    echo "Full Profile Data:\n";
    print_r($profile->toArray());
} else {
    echo "No employer profile found\n";
}
