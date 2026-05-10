@props([
    'eyebrow' => null,
    'title' => null,
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between']) }}>
    <div class="max-w-3xl space-y-3">
        @if($eyebrow)
            <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-300/80">{{ $eyebrow }}</p>
        @endif

        @if($title)
            <h1 class="text-3xl font-semibold tracking-tight text-white md:text-4xl">{{ $title }}</h1>
        @endif

        @if($description)
            <p class="max-w-3xl text-sm leading-7 text-slate-400 md:text-base">{{ $description }}</p>
        @endif
    </div>

    @isset($actions)
        <div class="flex flex-wrap gap-3 lg:justify-end">
            {{ $actions }}
        </div>
    @endisset
</div>
