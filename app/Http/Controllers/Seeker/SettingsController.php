<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('seeker.settings', [
            'user' => $user,
            'twoFAEnabled' => false,
            'notificationsEnabled' => true,
            'activeSessions' => 1,
            'lastLogin' => 'Today',
        ]);
    }
}
