<li class="{{ $topliclass }}">
    <a
        href="{{ $href }}"
        class="group flex gap-x-3 rounded-lg p-3 text-sm font-medium transition-all duration-200
        {{ $active ? 'bg-[#52A758] text-white' : 'text-slate-300 hover:text-white hover:bg-white/10' }}"
    >
        <svg
            class="size-5 shrink-0 transition-colors duration-200 {{ $active ? 'text-white' : 'text-slate-400 group-hover:text-white' }}"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="2"
            stroke="currentColor"
            aria-hidden="true"
            data-slot="icon"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="{{ $icon }}"
            />
            @if($icon2)
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="{{ $icon2 }}"
            />
            @endif
        </svg>
        <span class="truncate">{{ $slot }}</span>
        @if($active)
        <span class="ml-auto flex h-2 w-2 items-center">
            <span class="absolute inline-flex h-2 w-2 animate-ping rounded-full bg-white opacity-75"></span>
            <span class="relative inline-flex h-2 w-2 rounded-full bg-white"></span>
        </span>
        @endif
    </a>
</li>
