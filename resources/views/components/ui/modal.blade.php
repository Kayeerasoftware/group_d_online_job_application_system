@props([
    'id',
    'title',
    'description' => null,
])

<dialog
    id="{{ $id }}"
    data-modal
    class="modal-shell w-[min(100vw-1.5rem,42rem)] border-0 bg-transparent p-0 text-slate-100 shadow-2xl shadow-slate-950/60"
>
    <div class="modal-card overflow-hidden p-6 md:p-7">
        <div class="flex items-start justify-between gap-4">
            <div>
                <p class="section-eyebrow">Popup</p>
                <h2 class="mt-2 text-2xl font-semibold text-[color:var(--text)]">{{ $title }}</h2>
                @if($description)
                    <p class="mt-2 text-sm leading-6 text-[color:var(--text2)]">{{ $description }}</p>
                @endif
            </div>

            <button
                type="button"
                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl border border-[color:var(--border)] bg-[color:var(--surface2)] text-[color:var(--text)] transition hover:bg-[color:var(--surface)]"
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
