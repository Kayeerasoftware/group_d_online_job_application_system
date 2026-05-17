<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\EmployerProfile;

// Get the latest employer profile
$profile = EmployerProfile::latest()->first();

if ($profile) {
    echo "Before update:\n";
    echo "Company Logo: " . ($profile->getRawOriginal('company_logo') ?? 'NULL') . "\n\n";
    
    // Try to update with a test path
    $testPath = 'logos/test-logo.png';
    $profile->update(['company_logo' => $testPath]);
    
    // Refresh from database
    $profile->refresh();
    
    echo "After update:\n";
    echo "Company Logo (raw): " . ($profile->getRawOriginal('company_logo') ?? 'NULL') . "\n";
    echo "Company Logo (accessor): " . ($profile->company_logo ?? 'NULL') . "\n";
    
    // Check database directly
    $dbProfile = EmployerProfile::find($profile->id);
    echo "\nFrom fresh query:\n";
    echo "Company Logo (raw): " . ($dbProfile->getRawOriginal('company_logo') ?? 'NULL') . "\n";
    echo "Company Logo (accessor): " . ($dbProfile->company_logo ?? 'NULL') . "\n";
} else {
    echo "No employer profile found\n";
}
