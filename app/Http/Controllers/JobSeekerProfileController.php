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
        return view('jobseeker.profile');
    }

    public function edit(Request $request): View
    {
        $profile = $request->user()->seekerProfile()->firstOrCreate(['user_id' => $request->user()->id]);

        return view('profiles.seeker.edit', compact('profile'));
    }

    public function update(UpdateJobSeekerProfileRequest $request): RedirectResponse
    {
        $profile = $request->user()->seekerProfile()->firstOrCreate(['user_id' => $request->user()->id]);

        $data = $request->validated();

        if (isset($data['skills'])) {
            $data['skills'] = collect(explode(',', $data['skills']))
                ->map(fn ($skill) => trim($skill))
                ->filter()
                ->values()
                ->all();
        }

        if (isset($data['notification_preferences'])) {
            $data['notification_preferences'] = $data['notification_preferences'];
        }

        if ($request->hasFile('resume_path')) {
            $data['resume_path'] = $request->file('resume_path')->store('resumes', 'public');
        }

        $profile->update($data);

        return redirect()->route('seeker.profile.edit')->with('status', 'Profile updated successfully.');
    }

    public function destroy(JobSeekerProfile $jobSeekerProfile)
    {
        abort(404);
    }
}
