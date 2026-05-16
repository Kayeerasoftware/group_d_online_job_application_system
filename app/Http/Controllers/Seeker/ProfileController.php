<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobSeekerProfileRequest;
use App\Http\Requests\UpdateJobSeekerProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $profile = $request->user()->jobSeekerProfile;
        
        return view('seeker.profile-edit', compact('profile'));
    }
    
    public function update(UpdateJobSeekerProfileRequest $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->jobSeekerProfile;
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        $data = $request->validated();
        
        if ($request->hasFile('cv')) {
            if ($profile && $profile->cv_path) {
                Storage::disk('public')->delete($profile->cv_path);
            }
            $data['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }
        
        if ($profile) {
            $profile->update($data);
        } else {
            $user->jobSeekerProfile()->create($data);
        }
        
        return redirect()->route('seeker.profile.edit')
            ->with('success', 'Profile updated successfully!');
    }
}
