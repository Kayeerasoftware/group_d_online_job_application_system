<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        
        $settings = [
            'notify_applications' => $user->settings['notify_applications'] ?? true,
            'notify_job_closing' => $user->settings['notify_job_closing'] ?? true,
            'notify_interviews' => $user->settings['notify_interviews'] ?? true,
            'notify_weekly_summary' => $user->settings['notify_weekly_summary'] ?? true,
        ];

        return view('employer.settings', [
            'user' => $user,
            'settings' => $settings,
        ]);
    }

    public function updateNotifications(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'notify_applications' => 'boolean',
            'notify_job_closing' => 'boolean',
            'notify_interviews' => 'boolean',
            'notify_weekly_summary' => 'boolean',
        ]);

        $user = $request->user();
        $user->settings = array_merge($user->settings ?? [], $validated);
        $user->save();

        return redirect()->back()->with('success', 'Notification settings updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully');
    }
}
