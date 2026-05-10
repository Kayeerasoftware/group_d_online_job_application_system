@props([
    'id',
    'title',
    'description' => null,
])

<dialog
    id="{{ $id }}"
    data-modal
    class="w-[min(100vw-1.5rem,42rem)] rounded-[32px] border-0 bg-transparent p-0 text-slate-100 shadow-2xl shadow-slate-950/60"
>
    <div class="overflow-hidden rounded-[32px] border border-white/10 bg-slate-950/95 p-6 backdrop-blur-xl md:p-7">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-cyan-300/80">Popup</p>
                <h2 class="mt-2 text-2xl font-semibold text-white">{{ $title }}</h2>
                @if($description)
                    <p class="mt-2 text-sm leading-6 text-slate-400">{{ $description }}</p>
                @endif
            </div>

            <button
                type="button"
                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-slate-200 transition hover:bg-white/10"
                data-modal-close
                aria-label="Close popup"
            >
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18" />
                </svg>
            </button>
        </div>

        <div class="mt-6">
            {{ $slot }}
        </div>
    </div>
</dialog>
