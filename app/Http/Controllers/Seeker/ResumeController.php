<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function index(Request $request): View
    {
        $profile = $request->user()->seekerProfile;

        return view('seeker.resume', [
            'profile' => $profile,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $user = $request->user();
        $profile = $user->seekerProfile;

        if (!$profile) {
            $profile = $user->seekerProfile()->create([]);
        }

        // Delete old CV if exists
        if ($profile->cv_path && Storage::disk('public')->exists($profile->cv_path)) {
            Storage::disk('public')->delete($profile->cv_path);
        }

        // Store new CV
        $cvPath = $request->file('cv')->store('resumes', 'public');
        $profile->update(['cv_path' => $cvPath]);

        return redirect()->route('seeker.resume')
            ->with('success', 'Resume uploaded successfully!');
    }
}
