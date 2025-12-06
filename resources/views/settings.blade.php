<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Home'],
        ['url' => '#', 'label' => 'Settings'],
    ]" />

    <x-dynamic-heading title="Settings" />

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Main Content Section (col-8) -->
        <div class="lg:col-span-8">
            <!-- Master Files Section -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-4">Master Files</h3>
                    <ul role="list" class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                        @can('view countries')
                            <x-setting-link initials="MC" url="{{ url('countries') }}" title="Manage" subtitle="Countries"
                                bgColor="bg-green-500" />
                        @endcan

                        @can('view cities')
                            <x-setting-link initials="MC" url="{{ url('cities') }}" title="Manage" subtitle="Cities"
                                bgColor="bg-yellow-500" />
                        @endcan
                    </ul>
                </div>
            </div>

            <!-- User Management Section -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-4">User Management</h3>
                    <ul role="list" class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                        <x-setting-link
                            initials="MU"
                            url="{{ url('users')}}"
                            title="Manage"
                            subtitle="Users"
                            bgColor="bg-purple-600"
                        />

                        @can('view roles')
                            <x-setting-link
                                initials="MR"
                                url="{{ url('roles')}}"
                                title="Manage"
                                subtitle="Roles"
                                bgColor="bg-yellow-500"
                            />
                        @endcan

                        @can('view permissions')
                            <x-setting-link
                                initials="MP"
                                url="{{ url('permissions')}}"
                                title="Manage"
                                subtitle="Permission"
                                bgColor="bg-green-500"
                            />
                        @endcan
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar Section (col-4) -->
        <div class="lg:col-span-4">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-4">Quick Info</h3>
                    <div class="space-y-4">
                        <div class="border-l-4 border-[#52A758] pl-4">
                            <p class="text-sm font-medium text-gray-900">Settings Overview</p>
                            <p class="text-sm text-gray-600 mt-1">Manage your application's master files and user access controls from this central hub.</p>
                        </div>
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm font-medium text-gray-900">Need Help?</p>
                            <p class="text-sm text-gray-600 mt-1">Contact your system administrator if you need additional permissions or assistance.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
