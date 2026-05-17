<?php

namespace App\Http\Controllers\Employer;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AllEmployersController extends Controller
{
    private const EMPLOYERS_PER_PAGE = 12;

    public function index(Request $request): View
    {
        $employers = User::query()
            ->where('role', UserRole::Employer)
            ->where('is_active', true)
            ->withCount('jobs')
            ->when($request->filled('search'), fn ($q) => $this->applySearch($q, $request))
            ->when($request->filled('sort'), fn ($q) => $this->applySort($q, $request), fn ($q) => $q->latest())
            ->paginate(self::EMPLOYERS_PER_PAGE)
            ->withQueryString();

        return view('employer.all-employers', compact('employers'));
    }

    private function applySearch($query, Request $request)
    {
        $term = $request->string('search')->trim()->toString();
        
        return $query->where(function ($builder) use ($term) {
            $builder->where('name', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%");
        });
    }

    private function applySort($query, Request $request)
    {
        [$column, $direction] = $this->getSortOrder($request);
        return $query->orderBy($column, $direction);
    }

    private function getSortOrder(Request $request): array
    {
        return match ($request->string('sort')->toString()) {
            'jobs_desc' => ['jobs_count', 'desc'],
            'jobs_asc' => ['jobs_count', 'asc'],
            'name_asc' => ['name', 'asc'],
            'name_desc' => ['name', 'desc'],
            default => ['created_at', 'desc'],
        };
    }
}
