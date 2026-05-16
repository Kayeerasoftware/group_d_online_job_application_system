@extends('layouts.jobseeker')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
<div class="flex items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="font-serif text-3xl text-[color:var(--text)]">Good morning, {{ auth()->user()->name }} 👋</h1>
        <p class="mt-1 text-sm text-[color:var(--text2)]">You have {{ $unreadNotifications }} new updates on your applications</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="inline-flex items-center gap-2 rounded-full border border-[color:var(--border)] bg-[color:var(--accent-light)] px-4 py-2 text-sm font-medium text-[color:var(--accent)]">
            <span class="h-2 w-2 rounded-full bg-[color:var(--accent)]"></span>
            Profile {{ $profileCompletion }}% complete
        </span>
        <a href="{{ route('seeker.profile.edit') }}" class="rounded-xl border border-[color:var(--border)] bg-[color:var(--surface2)] px-4 py-2 text-sm font-medium text-[color:var(--text)] transition hover:bg-[color:var(--surface)]">Edit Profile</a>
    </div>
</div>

<div class="grid gap-4 md:grid-cols-4 mb-6">
    <div class="rounded-2xl bg-[color:var(--surface2)] p-5">
        <p class="text-xs text-[color:var(--text3)]">Applications</p>
        <p class="mt-2 text-3xl font-semibold text-[color:var(--text)]">{{ $stats['applications'] }}</p>
        <p class="mt-1 text-xs text-[color:var(--text2)]">↑ {{ $stats['applications_this_week'] }} this week</p>
    </div>
    <div class="rounded-2xl bg-[color:var(--surface2)] p-5">
        <p class="text-xs text-[color:var(--text3)]">Shortlisted</p>
        <p class="mt-2 text-3xl font-semibold text-[color:var(--amber)]">{{ $stats['shortlisted'] }}</p>
        <p class="mt-1 text-xs text-[color:var(--text2)]">Awaiting interview</p>
    </div>
    <div class="rounded-2xl bg-[color:var(--surface2)] p-5">
        <p class="text-xs text-[color:var(--text3)]">Saved Jobs</p>
        <p class="mt-2 text-3xl font-semibold text-[color:var(--blue)]">{{ $stats['saved_jobs'] }}</p>
        <p class="mt-1 text-xs text-[color:var(--text2)]">{{ $stats['closing_soon'] }} closing soon</p>
    </div>
    <div class="rounded-2xl bg-[color:var(--surface2)] p-5">
        <p class="text-xs text-[color:var(--text3)]">Profile Views</p>
        <p class="mt-2 text-3xl font-semibold text-[color:var(--text)]">{{ $stats['profile_views'] }}</p>
        <p class="mt-1 text-xs text-[color:var(--text2)]">Last 30 days</p>
    </div>
</div>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 space-y-6">
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-[color:var(--text)]">Recent Applications</h2>
                <a href="{{ route('applications.index') }}" class="text-sm font-medium text-[color:var(--accent)] hover:underline">View all</a>
            </div>
            <div class="overflow-hidden rounded-xl border border-[color:var(--border)]">
                <table class="w-full">
                    <thead class="bg-[color:var(--surface2)]">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--text3)]">Job Title</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--text3)]">Company</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--text3)]">Applied</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--text3)]">Status</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[color:var(--border)]">
                        @forelse($recentApplications as $application)
                        <tr class="hover:bg-[color:var(--surface2)] transition">
                            <td class="px-4 py-3 font-medium text-[color:var(--text)]">{{ $application->job->title }}</td>
                            <td class="px-4 py-3 text-sm text-[color:var(--text2)]">{{ $application->job->company_name }}</td>
                            <td class="px-4 py-3 text-sm text-[color:var(--text3)]">{{ $application->created_at->format('M d') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium
                                    @if($application->status === 'pending') bg-[color:var(--surface2)] text-[color:var(--text2)]
                                    @elseif($application->status === 'reviewed') bg-[color:var(--amber-light)] text-[color:var(--amber)]
                                    @elseif($application->status === 'shortlisted') bg-[color:var(--accent-light)] text-[color:var(--accent)]
                                    @elseif($application->status === 'rejected') bg-[color:var(--red-light)] text-[color:var(--red)]
                                    @endif">
                                    {{ ucfirst($application->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('applications.show', $application) }}" class="rounded-lg border border-[color:var(--border)] bg-[color:var(--surface2)] px-3 py-1 text-xs font-medium text-[color:var(--text)] hover:bg-[color:var(--border)] transition">Details</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-sm text-[color:var(--text3)]">No applications yet. <a href="{{ route('jobs.index') }}" class="text-[color:var(--accent)] hover:underline">Browse jobs</a></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($trackedApplication)
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-6">
            <h2 class="text-lg font-semibold text-[color:var(--text)] mb-4">Application Tracker — {{ $trackedApplication->job->title }}</h2>
            <div class="flex items-center">
                @foreach(['applied', 'reviewed', 'shortlisted', 'interview', 'hired'] as $index => $stage)
                <div class="flex flex-col items-center flex-1">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-semibold
                        @if($trackedApplication->status === $stage) bg-[color:var(--blue)] text-white
                        @elseif(array_search($trackedApplication->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) bg-[color:var(--accent)] text-white
                        @else bg-[color:var(--surface2)] text-[color:var(--text3)] border border-[color:var(--border)]
                        @endif">
                        @if(array_search($trackedApplication->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index)
                            ✓
                        @else
                            {{ $index + 1 }}
                        @endif
                    </div>
                    <p class="mt-2 text-xs text-center
                        @if($trackedApplication->status === $stage) text-[color:var(--blue)] font-medium
                        @elseif(array_search($trackedApplication->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) text-[color:var(--accent)]
                        @else text-[color:var(--text3)]
                        @endif">
                        {{ ucfirst($stage) }}
                    </p>
                </div>
                @if($index < 4)
                <div class="h-0.5 flex-1 -mt-8 @if(array_search($trackedApplication->status, ['applied', 'reviewed', 'shortlisted', 'interview', 'hired']) > $index) bg-[color:var(--accent)] @else bg-[color:var(--border)] @endif"></div>
                @endif
                @endforeach
            </div>
            @if($trackedApplication->status === 'shortlisted')
            <div class="mt-4 rounded-xl bg-[color:var(--accent-light)] p-4 text-sm text-[color:var(--accent)]">
                🎉 Congratulations! You've been shortlisted. Expect a call from HR within 2 working days.
            </div>
            @endif
        </div>
        @endif
    </div>

    <div class="space-y-6">
        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[color:var(--accent-light)] font-serif text-2xl text-[color:var(--accent)]">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <h3 class="mt-3 font-semibold text-[color:var(--text)]">{{ auth()->user()->name }}</h3>
            <p class="text-sm text-[color:var(--text2)]">{{ auth()->user()->jobSeekerProfile->job_title ?? 'Job Seeker' }} · {{ auth()->user()->jobSeekerProfile->location ?? 'Uganda' }}</p>
            <div class="mt-3">
                <div class="h-1.5 w-full overflow-hidden rounded-full bg-[color:var(--surface2)]">
                    <div class="h-full rounded-full bg-[color:var(--accent)]" style="width: {{ $profileCompletion }}%"></div>
                </div>
                <p class="mt-1 text-xs text-[color:var(--text3)]">Profile {{ $profileCompletion }}% complete</p>
            </div>
        </div>

        <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5">
            <h3 class="font-semibold text-[color:var(--text)] mb-3">Recent Notifications</h3>
            <div class="space-y-3">
                @forelse($recentNotifications as $notification)
                <div class="flex items-start gap-3 rounded-xl p-3 hover:bg-[color:var(--surface2)] transition">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full
                        @if($notification->type === 'application_status') bg-[color:var(--accent-light)]
                        @elseif($notification->type === 'job_closing') bg-[color:var(--amber-light)]
                        @else bg-[color:var(--blue-light)]
                        @endif">
                        @if($notification->type === 'application_status') ✉️
                        @elseif($notification->type === 'job_closing') 🔔
                        @else 👁️
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-[color:var(--text)]">{{ $notification->title }}</p>
                        <p class="text-xs text-[color:var(--text3)]">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @if(!$notification->read_at)
                    <span class="h-2 w-2 shrink-0 rounded-full bg-[color:var(--accent2)]"></span>
                    @endif
                </div>
                @empty
                <p class="text-sm text-[color:var(--text3)] text-center py-4">No notifications</p>
                @endforelse
            </div>
            <a href="{{ route('seeker.notifications.index') }}" class="mt-3 block text-center text-sm font-medium text-[color:var(--accent)] hover:underline">View all notifications</a>
        </div>
    </div>
</div>
</div>
@endsection
