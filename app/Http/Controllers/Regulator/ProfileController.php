<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(): View
    {
        return view('regulator.profile', ['user' => auth()->user()]);
    }

    public function edit(): View
    {
        return view('regulator.profile-edit', ['user' => auth()->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'department' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0|max:100',
            'education_level' => 'nullable|string|max:255',
            'specializations' => 'nullable|string',
            'bio' => 'nullable|string|max:1000',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ];

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            // Store new picture
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $updateData['profile_picture'] = $path;
        }

        // Update user data
        $user->update($updateData);

        return redirect()->route('regulator.profile.edit')
            ->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update(['password' => bcrypt($validated['password'])]);

        return redirect()->route('regulator.profile.edit')
            ->with('success', 'Password updated successfully.');
    }
}
