@php
    $alertMode = $alertMode ?? 'stack';
@endphp

@if ($errors->any())
    @php
        $errorMessages = $errors->all();
        $primaryError = $errors->first();
        $secondaryErrors = array_values(array_filter(
            $errorMessages,
            fn ($error) => $error !== $primaryError
        ));
    @endphp

    @if ($alertMode === 'dialog')
        <div class="auth-alert-dialog mb-6" role="alert" aria-live="assertive" aria-atomic="true" data-alert>
            <button type="button" class="auth-alert-dialog__close" data-alert-dismiss aria-label="Dismiss alert">
                <svg viewBox="0 0 24 24" class="auth-alert-dialog__close-icon" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18" />
                </svg>
            </button>

            <div class="auth-alert-dialog__icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" class="auth-alert-dialog__icon-svg" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v5m0 4h.01" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                </svg>
            </div>

            <div class="auth-alert-dialog__content">
                <p class="auth-alert-dialog__eyebrow">Authentication error</p>
                <h2 class="auth-alert-dialog__title">Please fix the highlighted issues.</h2>
                <p class="auth-alert-dialog__message">{{ $primaryError }}</p>

                @if (count($secondaryErrors))
                    <ul class="auth-alert-dialog__list">
                        @foreach ($secondaryErrors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @else
        <div class="mb-6 rounded-[28px] border border-rose-500/20 bg-rose-500/10 p-4 text-rose-100 shadow-lg shadow-rose-950/10">
            <div class="flex gap-3">
                <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-rose-500/15 text-sm font-semibold text-rose-200">!</div>
                <div>
                    <p class="font-semibold">Please fix the highlighted issues.</p>
                    <ul class="mt-3 space-y-2 text-sm text-rose-100/90">
                        @foreach ($errorMessages as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
@endif

@if (session('status'))
    <div class="mb-6 rounded-[28px] border border-emerald-500/20 bg-emerald-500/10 p-4 text-emerald-100 shadow-lg shadow-emerald-950/10">
        <div class="flex gap-3">
            <div class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-emerald-500/15 text-sm font-semibold text-emerald-200">&#10003;</div>
            <div>
                <p class="font-semibold">Success</p>
                <p class="mt-1 text-sm text-emerald-100/90">{{ session('status') }}</p>
            </div>
        </div>
    </div>
@endif
