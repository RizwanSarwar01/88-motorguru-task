<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Home'],
        ['url' => '/settings', 'label' => 'Settings'],
        ['url' => '#', 'label' => 'Countries'],
    ]" />
    <x-dynamic-heading title="Countries" />

    <div class="">
        <div class=" mx-auto">


            @if (Session::has('success'))
                <x-success-alert message="{{ Session::get('success') }}" />
            @endif

            <!-- Card Container -->
            <div class="bg-white shadow rounded-lg p-6">


                <div class="space-y-4 pb-8">
                    <!-- Header with Countries Heading -->
                    <!-- Search Form and Add Country Button -->
                    <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                        <!-- Search Form -->
                        <form action="{{ route('countries.index') }}" method="GET" class="flex w-full max-w-md">
                            <div class="relative flex-grow">
                                <span class="relative isolate block">


                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="relative block w-full appearance-none rounded-l-lg pl-10 px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 border border-zinc-950/10 bg-transparent dark:bg-white/5 focus:outline-none focus:ring-1 focus:ring-[#52a758]"
                                        placeholder="Search by Country Name or Code...">
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
                        <!-- Add Country Button -->
                        <div class="ml-0 sm:ml-4 mt-4 sm:mt-0 w-full sm:w-auto">
                            @can('create countries')
                                <a href="{{ route('countries.create') }}"
                                    class="flex items-center justify-center gap-2 rounded-md bg-[#52a758] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#469d4c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#52a758] transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Add New Country
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
                                        #
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-5/12">
                                        Country Name
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-2/12">
                                        Country Code
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-2/12">
                                        Created At
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-2/12">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($countries->isNotEmpty())
                                    @foreach ($countries as $country)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $loop->iteration + ($countries->currentPage() - 1) * $countries->perPage() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-[#52a758] to-[#469d4c] rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-md">
                                                        {{ strtoupper(substr($country->country_name, 0, 2)) }}
                                                    </div>
                                                    <div class="ml-4">
                                                        <span class="font-medium text-gray-900">{{ $country->country_name }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#134d75] bg-opacity-10 text-[#134d75]">
                                                    {{ strtoupper($country->country_code) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ \Carbon\Carbon::parse($country->created_at)->format('d M, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    @can('edit countries')
                                                        <a href="{{ route('countries.edit', $country->id) }}"
                                                            class="inline-flex items-center px-3 py-1.5 bg-[#134d75] text-white text-xs font-medium rounded-md hover:bg-[#0f3d5e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#134d75] transition-colors duration-200">
                                                            Edit
                                                        </a>
                                                    @endcan
                                                    @can('delete countries')
                                                        <form
                                                            @submit.prevent="showModal = true; deleteId = {{ $country->id }}"
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
                                        <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">
                                            No countries found.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>


                    <!-- Code for Delete -->
                    <x-delete-modal title="Delete Country"
                        message="Are you sure you want to delete this Country? This action cannot be undone."
                        :actionUrl="route('countries.destroy', '_ID_')" />
                </div>
                <!-- Code for Delete -->


                <!-- Pagination -->
                <div class="mt-4">
                    {{ $countries->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
