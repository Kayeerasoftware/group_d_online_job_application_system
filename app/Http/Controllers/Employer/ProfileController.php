<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEmployerProfileRequest;
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

        $profileCompletion = $this->calculateProfileCompletion($user, $profile);

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

        return view('employer.profile', compact(
            'profile',
            'profileCompletion',
            'activeJobs',
            'closedJobs',
            'totalApplications',
            'shortlistedCount',
            'rejectedCount',
            'pendingCount'
        ));
    }

    public function edit(Request $request): View
    {
        $profile = $request->user()->employerProfile ?? new EmployerProfile();

        return view('employer.profile-edit', compact('profile'));
    }

    public function update(UpdateEmployerProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->employerProfile;

        $data = $request->validated();

        // Handle company logo upload
        if ($request->hasFile('company_logo') && $request->file('company_logo')->isValid()) {
            if ($profile && $profile->company_logo) {
                @unlink(public_path($profile->company_logo));
            }
            $file = $request->file('company_logo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/logos'), $filename);
            $data['company_logo'] = 'uploads/logos/' . $filename;
        }

        // Update user email and phone
        $user->update([
            'email' => $data['email'],
            'phone' => $data['phone'] ?? $user->phone,
        ]);

        // Remove email and phone from profile data
        unset($data['email'], $data['phone']);

        // Update or create profile
        if ($profile) {
            $profile->update($data);
        } else {
            $data['user_id'] = $user->id;
            EmployerProfile::create($data);
        }

        return redirect()->route('employer.profile')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Calculate profile completion percentage based on employer profile data
     */
    private function calculateProfileCompletion($user, $profile): int
    {
        $fields = [
            $user->name,
            $user->email,
            $profile?->company_name,
            $profile?->industry,
            $profile?->company_website,
            $profile?->company_description,
            $profile?->company_logo,
            $profile?->tax_id,
        ];

        $completed = count(array_filter($fields));
        return (int) (($completed / count($fields)) * 100);
    }
}
