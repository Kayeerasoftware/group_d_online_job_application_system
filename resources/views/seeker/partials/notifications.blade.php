<div class="space-y-3">
    @forelse($recentNotifications ?? [] as $notification)
    <div class="flex items-start gap-4 rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-5 transition hover:bg-[color:var(--surface2)]">
        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full text-xl
            @if($notification->type === 'application_status') bg-[color:var(--accent-light)]
            @elseif($notification->type === 'application_shortlisted') bg-[color:var(--blue-light)]
            @elseif($notification->type === 'application_rejected') bg-[color:var(--red-light)]
            @elseif($notification->type === 'job_closing') bg-[color:var(--amber-light)]
            @elseif($notification->type === 'profile_viewed') bg-[color:var(--blue-light)]
            @else bg-[color:var(--surface2)]
            @endif">
            @if($notification->type === 'application_status') ✉️
            @elseif($notification->type === 'application_shortlisted') 🎉
            @elseif($notification->type === 'application_rejected') ❌
            @elseif($notification->type === 'job_closing') 🔔
            @elseif($notification->type === 'profile_viewed') 👁️
            @else 📬
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-3 mb-1">
                <h3 class="font-semibold text-[color:var(--text)]">{{ $notification->title }}</h3>
                @if(!$notification->read_at)
                <span class="h-2.5 w-2.5 shrink-0 rounded-full bg-[color:var(--accent2)]"></span>
                @endif
            </div>
            <p class="text-sm text-[color:var(--text2)] mb-2">{{ $notification->message }}</p>
            <div class="flex items-center gap-4 text-xs text-[color:var(--text3)]">
                <span>{{ $notification->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
    @empty
    <div class="rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface)] p-12 text-center">
        <p class="text-lg font-medium text-[color:var(--text)]">No notifications</p>
        <p class="mt-2 text-sm text-[color:var(--text2)]">You're all caught up!</p>
    </div>
    @endforelse
</div>
