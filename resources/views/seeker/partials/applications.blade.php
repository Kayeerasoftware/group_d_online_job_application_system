<div class="mb-6 flex items-center gap-3 border-b border-[color:var(--border)]">
    <a href="#applications" class="border-b-2 px-5 py-3 text-sm font-medium transition border-[color:var(--accent)] text-[color:var(--accent)]">
        All
    </a>
</div>

<div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] overflow-hidden">
    <table class="w-full">
        <thead class="bg-[color:var(--surface2)]">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--text3)]">Job</th>
                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--text3)]">Company</th>
                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--text3)]">Applied Date</th>
                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-[color:var(--text3)]">Status</th>
                <th class="px-6 py-4"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-[color:var(--border)]">
            @forelse($recentApplications ?? [] as $application)
            <tr class="hover:bg-[color:var(--surface2)] transition">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-semibold text-[color:var(--text)]">{{ $application->job->title }}</p>
                        <p class="text-sm text-[color:var(--text3)]">{{ $application->job->location }}</p>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-[color:var(--text2)]">{{ $application->job->company_name }}</td>
                <td class="px-6 py-4 text-sm text-[color:var(--text3)]">{{ $application->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium
                        @if($application->status === 'pending') bg-[color:var(--surface2)] text-[color:var(--text2)]
                        @elseif($application->status === 'reviewed') bg-[color:var(--amber-light)] text-[color:var(--amber)]
                        @elseif($application->status === 'shortlisted') bg-[color:var(--accent-light)] text-[color:var(--accent)]
                        @elseif($application->status === 'rejected') bg-[color:var(--red-light)] text-[color:var(--red)]
                        @endif">
                        {{ ucfirst($application->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('applications.show', $application) }}" class="rounded-lg border border-[color:var(--border)] bg-[color:var(--surface2)] px-4 py-2 text-sm font-medium text-[color:var(--text)] hover:bg-[color:var(--border)] transition">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center">
                    <p class="text-lg font-medium text-[color:var(--text)]">No applications yet</p>
                    <p class="mt-2 text-sm text-[color:var(--text2)]">Start applying to jobs</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
