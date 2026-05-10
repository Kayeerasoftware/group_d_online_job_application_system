<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IntegrationSetting;
use App\Services\Monitoring\SystemHealthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemController extends Controller
{
    public function index(SystemHealthService $healthService): View
    {
        $settings = IntegrationSetting::query()->orderBy('channel')->get()->keyBy('channel');

        return view('admin.system.index', [
            'health' => $healthService->snapshot(),
            'settings' => $settings,
        ]);
    }

    public function update(Request $request, IntegrationSetting $integrationSetting): RedirectResponse
    {
        $validated = $request->validate([
            'provider' => ['required', 'string', 'max:255'],
            'api_key' => ['nullable', 'string', 'max:255'],
            'api_secret' => ['nullable', 'string', 'max:255'],
            'from_name' => ['nullable', 'string', 'max:255'],
            'from_address' => ['nullable', 'email', 'max:255'],
            'sender_id' => ['nullable', 'string', 'max:255'],
            'enabled' => ['sometimes', 'boolean'],
            'notes' => ['nullable', 'string'],
        ]);

        $integrationSetting->update([
            ...$validated,
            'enabled' => $request->boolean('enabled'),
            'updated_by' => $request->user()->id,
        ]);

        return back()->with('status', ucfirst($integrationSetting->channel).' integration updated.');
    }
}
