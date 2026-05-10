<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployerProfileRequest;
use App\Http\Requests\UpdateEmployerProfileRequest;
use App\Models\EmployerProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EmployerProfileController extends Controller
{
    public function index()
    {
        abort(404);
    }

    public function create()
    {
        abort(404);
    }

    public function store(StoreEmployerProfileRequest $request)
    {
        abort(404);
    }

    public function show(EmployerProfile $employerProfile)
    {
        abort(404);
    }

    public function edit(Request $request): View
    {
        $profile = $request->user()->employerProfile()->firstOrCreate([
            'user_id' => $request->user()->id,
        ], [
            'company_name' => $request->user()->name,
        ]);

        return view('profiles.employer.edit', compact('profile'));
    }

    public function update(UpdateEmployerProfileRequest $request): RedirectResponse
    {
        $profile = $request->user()->employerProfile()->firstOrCreate([
            'user_id' => $request->user()->id,
        ], [
            'company_name' => $request->user()->name,
        ]);

        $data = $request->validated();

        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('company-logos', 'public');
        }

        $profile->update($data);

        return redirect()->route('employer.profile.edit')->with('status', 'Profile updated successfully.');
    }

    public function destroy(EmployerProfile $employerProfile)
    {
        abort(404);
    }
}
