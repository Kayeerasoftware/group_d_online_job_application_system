@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'page-header']) }}>
    <div class="max-w-3xl space-y-3">
        @if($eyebrow)
            <p class="section-eyebrow">{{ $eyebrow }}</p>
        @endif

        @if($title)
            <h1 class="page-title">{{ $title }}</h1>
        @endif

        @if($description)
            <p class="page-description">{{ $description }}</p>
        @endif
    </div>

    @isset($actions)
        <div class="flex flex-wrap gap-3 lg:justify-end">
            {{ $actions }}
        </div>
    @endisset
</div>
