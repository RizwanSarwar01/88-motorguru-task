@php
    // Helper function to get module name from permission
    function getModuleName($permission) {
        $name = $permission->name;
        // Remove CRUD prefixes
        $withoutCrud = preg_replace('/^(view|create|edit|delete)\s+/', '', $name);
        return $withoutCrud; // Return full name without truncating
    }

    // Helper function to check if permission is CRUD type
    function isCrudPermission($permission) {
        return str_starts_with($permission->name, 'view ') ||
               str_starts_with($permission->name, 'create ') ||
               str_starts_with($permission->name, 'edit ') ||
               str_starts_with($permission->name, 'delete ');
    }

    // Get all possible CRUD actions
    $crudActions = ['view', 'create', 'edit', 'delete'];

    // Separate CRUD and non-CRUD permissions
    $crudPermissions = $permissions->filter(function($permission) {
        return isCrudPermission($permission);
    });

    // Group CRUD permissions by module
    $modulePermissions = $crudPermissions->groupBy(function($permission) {
        return getModuleName($permission);
    })->sortKeys();

    // Filter modules to only include those with at least one CRUD action
    $modulePermissions = $modulePermissions->filter(function($perms) use ($crudActions) {
        return collect($crudActions)->some(function($action) use ($perms) {
            return $perms->contains(function($p) use ($action) {
                return str_starts_with($p->name, $action);
            });
        });
    });

    // Get permissions that don't follow CRUD pattern
    $otherPermissions = $permissions->filter(function($permission) {
        return !isCrudPermission($permission);
    });
@endphp

<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Home'],
        ['url' => '/settings', 'label' => 'Settings'],
        ['url' => route('roles.index'), 'label' => 'Roles'],
        ['url' => '#', 'label' => 'Create Role'],
    ]" />
    <x-dynamic-heading title="Create Role" />

    <div class="">
        <div class="mx-auto">
            <!-- Card Container -->
            <div class="bg-white shadow rounded-lg p-6">
                <!-- Form Start -->
                <form action="{{ route('roles.store') }}" method="POST" x-data="permissionsForm()">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                        <!-- Left Column - Role Name (col-8) -->
                        <div class="lg:col-span-8">
                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                                <input value="{{ old('name') }}"
                                    id="name"
                                    name="name"
                                    placeholder="Enter Role Name"
                                    type="text"
                                    class="relative block w-full appearance-none rounded-lg px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 border border-zinc-950/10 bg-transparent dark:bg-white/5 focus:outline-none focus:ring-1 focus:ring-[#52a758]">
                                @error('name')
                                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Permissions Field -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Permissions</label>
                                    <div class="flex gap-2">
                                        <button type="button" @click="checkAll"
                                            class="inline-flex items-center px-3 py-1.5 bg-[#52a758] text-white text-xs font-medium rounded-md hover:bg-[#469d4c] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#52a758] transition-colors duration-200">
                                            Check All
                                        </button>
                                        <button type="button" @click="uncheckAll"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                            Uncheck All
                                        </button>
                                    </div>
                                </div>

                                <!-- Module Based Permissions -->
                                <div class="overflow-x-auto rounded-lg border border-gray-200">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Module</th>
                                                @foreach($crudActions as $action)
                                                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-32">{{ $action }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($modulePermissions as $module => $modulePerms)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-br from-[#52a758] to-[#469d4c] rounded-full flex items-center justify-center text-white font-semibold text-xs shadow-md">
                                                                {{ strtoupper(substr($module, 0, 1)) }}
                                                            </div>
                                                            <div class="ml-3">
                                                                <span class="font-medium text-gray-900">{{ $module }}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @foreach($crudActions as $action)
                                                        <td class="px-6 py-4 text-center">
                                                            @php
                                                                $permission = $modulePerms->first(function($p) use ($action, $module) {
                                                                    return str_starts_with($p->name, $action . ' ' . $module);
                                                                });
                                                            @endphp
                                                            @if($permission)
                                                                <input type="checkbox"
                                                                    name="permission[]"
                                                                    value="{{ $permission->id }}"
                                                                    id="permission_{{ $action }}_{{ Str::slug($module) }}"
                                                                    x-model="selectedPermissions"
                                                                    class="rounded border-gray-300 text-[#52a758] shadow-sm focus:border-[#52a758] focus:ring-[#52a758] h-4 w-4">
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Other Permissions Section -->
                                @if($otherPermissions->isNotEmpty())
                                    <div class="mt-6">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Other Permissions</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 bg-gray-50 p-4 border border-gray-200 rounded-lg">
                                            @foreach($otherPermissions->sortBy('name') as $permission)
                                                <div class="flex items-center space-x-3 p-2 hover:bg-white rounded transition-colors duration-150">
                                                    <input type="checkbox"
                                                        name="permission[]"
                                                        value="{{ $permission->id }}"
                                                        id="permission_other_{{ $permission->id }}"
                                                        x-model="selectedPermissions"
                                                        class="rounded border-gray-300 text-[#52a758] shadow-sm focus:border-[#52a758] focus:ring-[#52a758] h-4 w-4">
                                                    <label for="permission_other_{{ $permission->id }}" class="text-sm text-gray-700 cursor-pointer">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @error('permissions')
                                    <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column - Actions (col-4) -->
                        <div class="lg:col-span-4">
                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg p-6 border border-gray-200 sticky top-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>

                                <div class="space-y-3">
                                    <!-- Submit Button -->
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 rounded-md bg-[#52a758] px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#469d4c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#52a758] transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        Create Role
                                    </button>

                                    <!-- Back Button -->
                                    <a href="{{ route('roles.index') }}"
                                        class="w-full flex items-center justify-center gap-2 rounded-md bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm border border-gray-300 hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500 transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                                        </svg>
                                        Back to Roles
                                    </a>
                                </div>

                                <!-- Info Box -->
                                <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-blue-800">Quick Tip</h3>
                                            <div class="mt-2 text-sm text-blue-700">
                                                <p>Select the appropriate permissions for this role. You can use the "Check All" or "Uncheck All" buttons for quick selection.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>

    <script>
        function permissionsForm() {
            return {
                selectedPermissions: [],
                uncheckAll() {
                    this.selectedPermissions = [];
                },
                checkAll() {
                    // Get all permission checkboxes
                    const checkboxes = document.querySelectorAll('input[name="permission[]"]');
                    // Map their values to an array
                    this.selectedPermissions = Array.from(checkboxes).map(cb => cb.value);
                }
            }
        }
    </script>
</x-app-layout>
