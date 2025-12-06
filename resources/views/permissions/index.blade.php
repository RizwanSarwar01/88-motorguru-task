<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Home'],
        ['url' => '/settings', 'label' => 'Settings'],
        ['url' => '#', 'label' => $title],
    ]" />
    <x-dynamic-heading title="{{ $title }}" />

    <div class="">
        <div class=" mx-auto">


            @if (Session::has('success'))
                <x-success-alert message="{{ Session::get('success') }}" />
            @endif

            <!-- Card Container -->
            <div class="bg-white shadow rounded-lg p-6">


                <div class="space-y-4 pb-8">
                    <!-- Header with Stores Heading -->
                    <!-- Search Form and Add Store Button -->
                    <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                        <!-- Search Form -->
                        <form action="{{ route('permissions.index') }}" method="GET" class="flex w-full max-w-md">
                            <div class="relative flex-grow">
                                <span class="relative isolate block">


                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="relative block w-full appearance-none rounded-l-lg pl-10 px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 border border-zinc-950/10 bg-transparent dark:bg-white/5 focus:outline-none focus:ring-1 focus:ring-[#52a758]"
                                        placeholder="Search by Permission Name...">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        aria-hidden="true"
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-zinc-500 dark:text-zinc-400 pointer-events-none">
                                        <path fill-rule="evenodd"
                                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </div>
                            <button type="submit"
                                class="flex items-center justify-center px-4 py-2 bg-[#52a758] text-white rounded-r-lg hover:bg-[#469d4c] focus:ring-2 focus:ring-[#52a758] focus:outline-none transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35M17 11A6 6 0 1 0 5 11a6 6 0 0 0 12 0z" />
                                </svg>
                            </button>
                        </form>
                        <!-- Add Store Button -->
                        <div class="ml-0 sm:ml-4 mt-4 sm:mt-0 w-full sm:w-auto">
                            @can('create permissions')
                                <a href="{{ route('permissions.create') }}"
                                    class="flex items-center justify-center gap-2 rounded-md bg-[#52a758] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#469d4c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#52a758] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Add New Permission
                                </a>
                            @endcan


                        </div>
                    </div>
                </div>

                <!-- Code for Delete -->
                <div x-data="{ showModal: false, deleteId: null }">
                    <!-- Code for Delete -->

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/12">
                                        ID
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/2">
                                        Name
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/4">
                                        Created At
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/6">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($permissions->isNotEmpty())
                                    @foreach ($permissions as $permission)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $permission->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-[#52a758] to-[#469d4c] rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                                        {{ strtoupper(substr($permission->name, 0, 1)) }}
                                                    </div>
                                                    <div class="ml-4">
                                                        <span class="font-medium text-gray-900">{{ $permission->name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    @can('edit permissions')
                                                        <a href="{{ route('permissions.edit', $permission->id) }}"
                                                            class="inline-flex items-center px-3 py-1.5 bg-[#134d75] text-white text-xs font-medium rounded-md hover:bg-[#0f3d5e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#134d75] transition-colors duration-200">
                                                            Edit
                                                        </a>
                                                    @endcan
                                                    @can('delete permissions')
                                                        <form
                                                            @submit.prevent="showModal = true; deleteId = {{ $permission->id }}"
                                                            class="inline"
                                                            data-loading="false"
                                                            data-modal="true">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">
                                            No permissions found.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>


                    <!-- Code for Delete -->
                    <x-delete-modal title="Delete Permission"
                        message="Are you sure you want to delete this Permission? This action cannot be undone."
                        :actionUrl="route('permissions.destroy', '_ID_')" />
                </div>
                <!-- Code for Delete -->


                <!-- Pagination -->
                <div class="mt-4">
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
