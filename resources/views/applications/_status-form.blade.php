@if(safe_auth_check() && (safe_auth_user()?->isEmployer() || safe_auth_user()?->isAdmin()))
    <form class="space-y-4" method="post" action="{{ route('applications.status', $application) }}">
        @csrf
        @method('patch')
        <div class="space-y-2">
            <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="status">Status</label>
            <select class="w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="status" name="status">
                @foreach(['pending','reviewed','shortlisted','rejected','hired'] as $status)
                    <option value="{{ $status }}" @selected($application->statusValue() === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>
        <div class="space-y-2">
            <label class="block text-xs uppercase tracking-[0.3em] text-slate-500" for="employer_notes">Private notes</label>
            <textarea class="min-h-32 w-full rounded-2xl border border-white/10 bg-slate-950/80 px-4 py-3 text-slate-100 placeholder:text-slate-500 outline-none transition focus:border-cyan-400/60 focus:ring-2 focus:ring-cyan-400/20" id="employer_notes" name="employer_notes" rows="5" placeholder="Add internal notes">{{ old('employer_notes', $application->employer_notes) }}</textarea>
        </div>
        <button class="inline-flex w-full items-center justify-center rounded-2xl bg-cyan-400 px-5 py-3 text-sm font-semibold text-slate-950 transition hover:bg-cyan-300" type="submit">Save status</button>
    </form>
@endif
