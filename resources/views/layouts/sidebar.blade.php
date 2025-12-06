<div>
    <!-- Mobile sidebar overlay -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm" aria-hidden="true" @click="sidebarOpen = false"></div>

        <div class="fixed inset-0 flex"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full">

            <div class="relative mr-16 flex w-full max-w-xs flex-1">
                <!-- Close button -->
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5 text-white hover:text-gray-300 transition-colors" @click="sidebarOpen = false">
                        <span class="sr-only">Close sidebar</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile Sidebar Content -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gradient-to-b from-orange-800 via-orange-900 to-orange-950 px-4 pb-4">
                    <!-- Logo Section -->
                    <div class="flex h-20 shrink-0 items-center border-b border-amber-600/30">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 w-full">
                            <img class="h-12 w-12 rounded-lg object-contain bg-white p-1.5" src="{{ asset('images/logo.png') }}" alt="88 Motor Guru" />
                            <div class="flex flex-col">
                                <span class="text-white font-bold text-lg leading-tight">88 Motor Guru</span>
                                <span class="text-orange-200 text-xs">Admin Panel</span>
                            </div>
                        </a>
                    </div>

                    <!-- Navigation -->
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-2">
                            <!-- Main Navigation -->
                            <li>
                                    <div class="text-xs font-semibold leading-6 text-orange-200 uppercase tracking-wider px-3 mb-2">Main</div>
                                    <ul role="list" class="space-y-1">
                                        <x-navigation-link href="{{ route('dashboard') }}" topliclass=""
                                            icon="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                            icon2="">
                                            Dashboard
                                        </x-navigation-link>
                                    </ul>

                                    @can('view employees')
                                        <x-navigation-link href="{{ route('employees.index') }}" topliclass=""
                                            icon="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                                            icon2="">
                                            Employees
                                        </x-navigation-link>
                                    @endcan


                            </li>

                            <!-- Management Section -->
                            <li>
                                <div class="text-xs font-semibold leading-6 text-orange-200 uppercase tracking-wider px-3 mb-2 mt-4">Management</div>
                                <ul role="list" class="space-y-1">
                                    @can('view users')
                                        <x-navigation-link href="{{ route('users.index') }}" topliclass=""
                                            icon="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                                            icon2="">
                                            Users
                                        </x-navigation-link>
                                    @endcan

                                    @can('view roles')
                                        <x-navigation-link href="{{ route('roles.index') }}" topliclass=""
                                            icon="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"
                                            icon2="">
                                            Roles
                                        </x-navigation-link>
                                    @endcan

                                    @can('view permissions')
                                        <x-navigation-link href="{{ route('permissions.index') }}" topliclass=""
                                            icon="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"
                                            icon2="">
                                            Permissions
                                        </x-navigation-link>
                                    @endcan
                                </ul>
                            </li>

                            <!-- Data Management Section -->
                            <li>
                                <div class="text-xs font-semibold leading-6 text-orange-200 uppercase tracking-wider px-3 mb-2 mt-4">Data</div>
                                <ul role="list" class="space-y-1">
                                    @can('view countries')
                                        <x-navigation-link href="{{ route('countries.index') }}" topliclass=""
                                            icon="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"
                                            icon2="">
                                            Countries
                                        </x-navigation-link>
                                    @endcan

                                    @can('view cities')
                                        <x-navigation-link href="{{ route('cities.index') }}" topliclass=""
                                            icon="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"
                                            icon2="">
                                            Cities
                                        </x-navigation-link>
                                    @endcan
                                </ul>
                            </li>

                            <!-- Settings Section -->
                            <li class="mt-auto pt-4 border-t border-amber-600/30">
                                @can('view settings')
                                    <x-navigation-link href="{{ route('settings') }}" topliclass=""
                                        icon="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28z"
                                        icon2="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                        Settings
                                    </x-navigation-link>
                                @endcan
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gradient-to-b from-orange-800 via-orange-900 to-orange-950 px-6 pb-4 border-r border-amber-600/30">
            <!-- Logo Section -->
            <div class="flex h-20 shrink-0 items-center border-b border-amber-600/30 mt-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 w-full group">
                    <div class="flex-shrink-0">
                        <img class="h-14 w-14 rounded-xl object-contain bg-white p-2 group-hover:shadow-lg transition-shadow"
                             src="{{ asset('images/logo.png') }}" alt="88 Motor Guru" />
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-white font-bold text-xl leading-tight truncate">88 Motor Guru</span>
                        <span class="text-orange-200 text-sm">Admin Panel</span>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-2">
                    <!-- Main Navigation -->
                    <li>
                        <div class="text-xs font-semibold leading-6 text-orange-200 uppercase tracking-wider px-3 mb-2">Main</div>
                        <ul role="list" class="space-y-1">
                            <x-navigation-link href="{{ route('dashboard') }}" topliclass=""
                                icon="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"
                                icon2="">
                                Dashboard
                            </x-navigation-link>
                        </ul>

                        @can('view employees')
                                        <x-navigation-link href="{{ route('employees.index') }}" topliclass=""
                                            icon="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                                            icon2="">
                                            Employees
                                        </x-navigation-link>
                                    @endcan
                    </li>

                    <!-- Management Section -->
                    <li>
                        <div class="text-xs font-semibold leading-6 text-orange-200 uppercase tracking-wider px-3 mb-2 mt-4">Management</div>
                        <ul role="list" class="space-y-1">
                            @can('view users')
                                <x-navigation-link href="{{ route('users.index') }}" topliclass=""
                                    icon="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"
                                    icon2="">
                                    Users
                                </x-navigation-link>
                            @endcan

                            @can('view roles')
                                <x-navigation-link href="{{ route('roles.index') }}" topliclass=""
                                    icon="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"
                                    icon2="">
                                    Roles
                                </x-navigation-link>
                            @endcan

                            @can('view permissions')
                                <x-navigation-link href="{{ route('permissions.index') }}" topliclass=""
                                    icon="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"
                                    icon2="">
                                    Permissions
                                </x-navigation-link>
                            @endcan
                        </ul>
                    </li>

                    <!-- Data Management Section -->
                    <li>
                        <div class="text-xs font-semibold leading-6 text-orange-200 uppercase tracking-wider px-3 mb-2 mt-4">Data</div>
                        <ul role="list" class="space-y-1">
                            @can('view countries')
                                <x-navigation-link href="{{ route('countries.index') }}" topliclass=""
                                    icon="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"
                                    icon2="">
                                    Countries
                                </x-navigation-link>
                            @endcan

                            @can('view cities')
                                <x-navigation-link href="{{ route('cities.index') }}" topliclass=""
                                    icon="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"
                                    icon2="">
                                    Cities
                                </x-navigation-link>
                            @endcan
                        </ul>
                    </li>

                    <!-- Settings Section -->
                    <li class="mt-auto pt-4 border-t border-amber-600/30">
                        @can('view settings')
                            <x-navigation-link href="{{ route('settings') }}" topliclass=""
                                icon="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28z"
                                    icon2="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                Settings
                            </x-navigation-link>
                        @endcan
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
