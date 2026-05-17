<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $activeSessions = 1;
        $lastLogin = $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never';

        return view('seeker.settings', compact('user', 'activeSessions', 'lastLogin'));
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => bcrypt($validated['password']),
        ]);

        return back()->with('status', 'Password updated successfully.');
    }

    public function updateNotifications(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'notifications_enabled' => 'boolean',
            'job_recommendations' => 'boolean',
            'application_updates' => 'boolean',
            'message_notifications' => 'boolean',
            'interview_reminders' => 'boolean',
        ]);

        $request->user()->update($validated);

        return back()->with('status', 'Notification preferences updated.');
    }

    public function updatePrivacy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'profile_visible' => 'boolean',
            'show_email' => 'boolean',
            'show_phone' => 'boolean',
        ]);

        $request->user()->update($validated);

        return back()->with('status', 'Privacy settings updated.');
    }

    public function updateAppearance(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'theme' => 'required|in:light,dark,auto',
        ]);

        $request->user()->update($validated);

        return back()->with('status', 'Appearance settings updated.');
    }

    public function enableTwoFactor(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if (!$user->two_factor_enabled) {
            $secret = bin2hex(random_bytes(16));
            $user->update([
                'two_factor_enabled' => true,
                'two_factor_secret' => $secret,
            ]);
            return back()->with('status', 'Two-factor authentication enabled.');
        }

        return back();
    }

    public function disableTwoFactor(Request $request): RedirectResponse
    {
        $user = $request->user();
        
        if ($user->two_factor_enabled) {
            $user->update([
                'two_factor_enabled' => false,
                'two_factor_secret' => null,
            ]);
            return back()->with('status', 'Two-factor authentication disabled.');
        }

        return back();
    }
}
