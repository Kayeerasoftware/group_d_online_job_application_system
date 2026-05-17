<?php

namespace App\Http\Controllers\Employer;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AllEmployersController extends Controller
{
    public function index(Request $request): View
    {
        $employers = User::query()
            ->where('role', UserRole::Employer)
            ->where('is_active', true)
            ->withCount('jobs')
            ->when($request->filled('search'), function ($query) use ($request): void {
                $term = $request->string('search')->toString();
                $query->where(function ($builder) use ($term): void {
                    $builder->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('sort'), function ($query) use ($request): void {
                $sort = $request->string('sort')->toString();
                match ($sort) {
                    'jobs_desc' => $query->orderByDesc('jobs_count'),
                    'jobs_asc' => $query->orderBy('jobs_count'),
                    'name_asc' => $query->orderBy('name'),
                    'name_desc' => $query->orderByDesc('name'),
                    default => $query->latest(),
                };
            }, fn ($query) => $query->latest())
            ->paginate(12)
            ->withQueryString();

        return view('employer.all-employers', compact('employers'));
    }
}
