<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobSeekerProfileRequest;
use App\Http\Requests\UpdateJobSeekerProfileRequest;
use App\Models\JobSeekerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JobSeekerProfileController extends Controller
{
    public function index()
    {
        abort(404);
    }

    public function create()
    {
        abort(404);
    }

    public function store(StoreJobSeekerProfileRequest $request)
    {
        abort(404);
    }

    public function show(Request $request): View
    {
        $user = $request->user();
        $profile = $user->seekerProfile;

        $profileCompletion = $this->calculateProfileCompletion($user, $profile);

        $applicationCount = $user->applications()->count();
        $shortlistedCount = $user->applications()->whereIn('status', ['shortlisted', 'hired'])->count();
        $interviewCount = $user->applications()->where('status', 'reviewed')->count();
        $skills = $profile?->skills ?? [];

        return view('seeker.profile', compact('profileCompletion', 'applicationCount', 'shortlistedCount', 'interviewCount', 'skills'));
    }

    public function edit(Request $request): View
    {
        $profile = $request->user()->seekerProfile()->firstOrCreate(['user_id' => $request->user()->id]);

        return view('seeker.profile-edit', compact('profile'));
    }

    public function update(UpdateJobSeekerProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->seekerProfile()->firstOrCreate(['user_id' => $user->id]);

        $data = $request->validated();

        $userData = [
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone,
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture') && $request->file('profile_picture')->isValid()) {
            if ($user->profile_picture) {
                @unlink(public_path('uploads/profile-pictures/' . basename($user->profile_picture)));
            }
            $file = $request->file('profile_picture');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile-pictures'), $filename);
            $userData['profile_picture'] = 'uploads/profile-pictures/' . $filename;
        }

        $user->update($userData);

        unset($data['profile_picture'], $data['name'], $data['email'], $data['phone']);

        if (isset($data['skills']) && !empty($data['skills'])) {
            $data['skills'] = collect(explode(',', $data['skills']))
                ->map(fn ($skill) => trim($skill))
                ->filter()
                ->values()
                ->all();
        }

        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            if ($profile->cv_path) {
                @unlink(public_path($profile->cv_path));
            }
            $file = $request->file('cv');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/cvs'), $filename);
            $data['cv_path'] = 'uploads/cvs/' . $filename;
        }

        $profile->update($data);

        return redirect()->route('seeker.profile.edit')->with('status', 'Profile updated successfully.');
    }

    public function destroy(JobSeekerProfile $jobSeekerProfile)
    {
        abort(404);
    }

    private function calculateProfileCompletion($user, $profile): int
    {
        $fields = [
            $user->name,
            $user->email,
            $user->phone,
            $profile?->location,
            $profile?->job_title,
            $profile?->years_experience,
            $profile?->skills,
            $profile?->bio,
            $profile?->cv_path,
        ];
        
        $completed = count(array_filter($fields));
        return (int) (($completed / count($fields)) * 100);
    }
}
