<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Home'],
        ['url' => '/settings', 'label' => 'Settings'],
        ['url' => '#', 'label' => 'Cities'],
    ]" />
    <x-dynamic-heading title="Cities" />

    <div class="">
        <div class=" mx-auto">


            @if (Session::has('success'))
                <x-success-alert message="{{ Session::get('success') }}" />
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Main Content Section (col-8) -->
                <div class="lg:col-span-8">
                    <!-- Card Container -->
                    <div class="bg-white shadow rounded-lg p-6">


                        <div class="space-y-4 pb-8">
                            <!-- Header with Cities Heading -->
                            <!-- Search Form and Add City Button -->
                            <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                                <!-- Search Form -->
                                <form action="{{ route('cities.index') }}" method="GET" class="flex w-full max-w-md">
                                    <div class="relative flex-grow">
                                        <span class="relative isolate block">


                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="relative block w-full appearance-none rounded-l-lg pl-10 px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 border border-zinc-950/10 bg-transparent dark:bg-white/5 focus:outline-none focus:ring-1 focus:ring-[#52a758]"
                                                placeholder="Search by city or country name...">
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
                                <!-- Add City Button -->
                                <div class="ml-0 sm:ml-4 mt-4 sm:mt-0 w-full sm:w-auto">
                                    @can('create cities')
                                        <a href="{{ route('cities.create') }}"
                                            class="flex items-center justify-center gap-2 rounded-md bg-[#52a758] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#469d4c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#52a758] transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                            Add New City
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            City Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Country
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $city->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $city->country->country_name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @can('edit cities')
                                                    <a href="{{ route('cities.edit', $city->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                @endcan
                                                @can('delete cities')
                                                    @can('edit cities')
                                                        <span class="text-gray-300">|</span>
                                                    @endcan
                                                    <form action="{{ route('cities.destroy', $city->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                                            onclick="return confirm('Are you sure you want to delete this city?')">Delete</button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $cities->links() }}
                        </div>
                    </div>
                </div>

                <!-- Sidebar Section (col-4) -->
                <div class="lg:col-span-4">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Info</h3>
                        <p class="text-sm text-gray-600">Manage your cities here. You can add, edit, or delete cities as needed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
