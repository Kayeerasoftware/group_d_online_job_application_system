<div class="mb-8">
    @if($eyebrow ?? null)
        <p class="text-sm font-semibold uppercase tracking-[0.35em] text-cyan-400">{{ $eyebrow }}</p>
    @endif
    
    <div class="mt-2 flex items-start justify-between gap-4">
        <div>
            @if($title ?? null)
                <h1 class="text-4xl font-bold text-white">{{ $title }}</h1>
            @endif
            
            @if($description ?? null)
                <p class="mt-2 text-lg text-slate-400">{{ $description }}</p>
            @endif
        </div>
        
        @if($actions ?? null)
            <div class="flex gap-3">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
