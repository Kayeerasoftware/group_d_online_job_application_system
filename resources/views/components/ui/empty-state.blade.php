@props([
    'title' => 'Nothing here yet',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'empty-state']) }}>
    <p class="empty-state__title">{{ $title }}</p>
    @if($description)
        <p class="empty-state__description">{{ $description }}</p>
    @endif
    {{ $slot }}
</div>
