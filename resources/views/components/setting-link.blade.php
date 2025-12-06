<li class="group col-span-1 flex rounded-md shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden">
    <div class="flex w-16 shrink-0 items-center justify-center text-sm font-medium text-white {{ $bgColor }} relative">
        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
        <span class="relative z-10 transform group-hover:scale-105 transition-transform duration-200">{{ $initials }}</span>
    </div>
    <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white group-hover:bg-gray-50 transition-colors duration-200">
        <div class="flex-1 truncate px-4 py-2 text-sm">
            <a href="{{ $url }}" class="font-medium text-gray-900 group-hover:text-[#52a758] transition-colors duration-200 flex items-center gap-1">
                {{ $title }}
                <svg class="w-3 h-3 opacity-0 -translate-x-1 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <p class="text-gray-500">{{ $subtitle }}</p>
        </div>
    </div>
</li>
