@props([
    'value' => '',
])

@php
    $status = strtolower(trim((string) $value));

    $classes = match ($status) {
        'pending' => 'status-badge--pending',
        'reviewed' => 'status-badge--reviewed',
        'shortlisted' => 'status-badge--shortlisted',
        'rejected' => 'status-badge--rejected',
        'hired' => 'status-badge--hired',
        default => 'status-badge',
    };

    $label = $status !== '' ? ucfirst($status) : 'Unknown';
@endphp

<span {{ $attributes->merge(['class' => 'status-badge ' . $classes]) }}>
    {{ $label }}
</span>
