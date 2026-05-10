@if ($errors->any())
    <div class="mb-6 rounded-[28px] border border-rose-500/20 bg-rose-500/10 p-4 text-rose-100 shadow-lg shadow-rose-950/20">
        <div class="flex gap-3">
            <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-rose-500/15 text-sm font-semibold text-rose-200">!</div>
            <div>
                <p class="font-semibold">Please fix the highlighted issues.</p>
                <ul class="mt-3 space-y-2 text-sm text-rose-100/90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if (session('status'))
    <div class="mb-6 rounded-[28px] border border-emerald-500/20 bg-emerald-500/10 p-4 text-emerald-100 shadow-lg shadow-emerald-950/20">
        <div class="flex gap-3">
            <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-500/15 text-sm font-semibold text-emerald-200">✓</div>
            <div>
                <p class="font-semibold">Success</p>
                <p class="mt-1 text-sm text-emerald-100/90">{{ session('status') }}</p>
            </div>
        </div>
    </div>
@endif
