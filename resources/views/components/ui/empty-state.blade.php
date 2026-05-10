@props([
    'title' => 'Nothing here yet',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-[28px] border border-white/10 bg-slate-950/70 px-6 py-10 text-center shadow-lg shadow-slate-950/20']) }}>
    <p class="text-lg font-semibold text-white">{{ $title }}</p>
    @if($description)
        <p class="mx-auto mt-3 max-w-2xl text-sm leading-7 text-slate-400">{{ $description }}</p>
    @endif
    {{ $slot }}
</div>
