<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\EmployerProfile;
use App\Models\JobSeekerProfile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone') ?: null,
            'role' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
            'is_active' => true,
        ]);

        if ($user->isSeeker()) {
            JobSeekerProfile::create(['user_id' => $user->id]);
        }

        if ($user->isEmployer()) {
            EmployerProfile::create([
                'user_id' => $user->id,
                'company_name' => $user->name,
                'verified_by_admin' => false,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('status', 'Account created successfully.');
    }
}
