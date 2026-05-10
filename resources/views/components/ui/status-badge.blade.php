@props([
    'value' => '',
])

@php
    $status = strtolower(trim((string) $value));

    $classes = match ($status) {
        'pending' => 'border-amber-400/20 bg-amber-400/10 text-amber-100',
        'reviewed' => 'border-cyan-400/20 bg-cyan-400/10 text-cyan-100',
        'shortlisted' => 'border-sky-400/20 bg-sky-400/10 text-sky-100',
        'rejected' => 'border-rose-400/20 bg-rose-400/10 text-rose-100',
        'hired' => 'border-emerald-400/20 bg-emerald-400/10 text-emerald-100',
        default => 'border-white/10 bg-white/5 text-slate-200',
    };

    $label = $status !== '' ? ucfirst($status) : 'Unknown';
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] '.$classes]) }}>
    {{ $label }}
</span>
