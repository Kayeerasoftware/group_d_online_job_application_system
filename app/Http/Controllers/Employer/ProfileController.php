<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\EmployerProfile;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $profile = $user->employerProfile;
        
        $activeJobs = $user->jobs()->where('status', 'open')->count();
        $closedJobs = $user->jobs()->where('status', 'closed')->count();
        
        $totalApplications = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))->count();
        
        $shortlistedCount = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->where('status', 'shortlisted')
            ->count();

        $rejectedCount = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->where('status', 'rejected')
            ->count();

        $pendingCount = Application::whereHas('job', fn($q) => $q->where('employer_id', $user->id))
            ->where('status', 'pending')
            ->count();

        $profileCompletion = $this->calculateProfileCompletion($user);

        return view('employer.profile', [
            'profile' => $profile,
            'profileCompletion' => $profileCompletion,
            'activeJobs' => $activeJobs,
            'closedJobs' => $closedJobs,
            'totalApplications' => $totalApplications,
            'shortlistedCount' => $shortlistedCount,
            'rejectedCount' => $rejectedCount,
            'pendingCount' => $pendingCount,
        ]);
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        $profile = $user->employerProfile ?? new EmployerProfile();

        return view('employer.profile-edit', [
            'profile' => $profile,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'industry' => 'required|string',
            'company_size' => 'required|string',
            'location' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'company_description' => 'nullable|string|max:2000',
            'logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = $request->user();
        
        if ($request->hasFile('logo_path')) {
            $path = $request->file('logo_path')->store('logos', 'public');
            $validated['logo_path'] = $path;
        }

        $user->employerProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('employer.profile')->with('success', 'Profile updated successfully');
    }

    /**
     * Calculate profile completion percentage based on employer profile data
     */
    private function calculateProfileCompletion($user): int
    {
        $completionPercentage = 0;
        $totalFields = 0;

        $profile = $user->employerProfile;

        if (!$profile) {
            return 0;
        }

        // Check basic user fields
        $totalFields += 2;
        if (!empty($user->name)) $completionPercentage += 1;
        if (!empty($user->email)) $completionPercentage += 1;

        // Check employer profile fields
        $profileFields = [
            'company_name',
            'company_description',
            'location',
            'website',
            'phone',
            'industry',
            'company_size',
            'logo_path',
        ];

        $totalFields += count($profileFields);

        foreach ($profileFields as $field) {
            if (!empty($profile->$field)) {
                $completionPercentage += 1;
            }
        }

        return $totalFields > 0 ? round(($completionPercentage / $totalFields) * 100) : 0;
    }
}
