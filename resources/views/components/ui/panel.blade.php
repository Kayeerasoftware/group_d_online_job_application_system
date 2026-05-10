@props([
    'as' => 'section',
    'tone' => 'surface',
])

@php
    $variants = [
        'surface' => 'border-white/10 bg-white/5',
        'inset' => 'border-white/10 bg-slate-950/70',
        'soft' => 'border-white/10 bg-slate-950/55',
        'warning' => 'border-amber-400/20 bg-amber-400/10',
        'success' => 'border-emerald-400/20 bg-emerald-400/10',
    ];

    $classes = trim('relative overflow-hidden rounded-[32px] border shadow-2xl shadow-slate-950/20 backdrop-blur-xl ' . ($variants[$tone] ?? $variants['surface']));
    $tag = $as;
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
    <div class="relative h-full">
        {{ $slot }}
    </div>
</{{ $tag }}>
