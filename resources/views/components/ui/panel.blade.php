@props([
    'as' => 'section',
    'tone' => 'surface',
])

@php
    $variants = [
        'surface' => 'surface-card',
        'inset' => 'surface-card surface-card--inset',
        'soft' => 'surface-card surface-card--soft',
        'warning' => 'surface-card surface-card--warning',
        'success' => 'surface-card surface-card--success',
    ];

    $classes = trim('relative ' . ($variants[$tone] ?? $variants['surface']));
    $tag = $as;
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
    <div class="relative h-full">
        {{ $slot }}
    </div>
</{{ $tag }}>
