<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        return match (true) {
            $user->isAdmin() => redirect()->route('admin.dashboard'),
            $user->isEmployer() => redirect()->route('employer.dashboard'),
            default => redirect()->route('seeker.dashboard'),
        };
    }
}
