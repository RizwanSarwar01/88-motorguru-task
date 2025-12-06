<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Dashboard'],
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
                    <!-- Search Form and Add Employee Button -->
                    <div class="flex flex-col space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                        <!-- Search Form -->
                        <form action="{{ route('employees.index') }}" method="GET" class="flex w-full max-w-md">
                            <div class="relative flex-grow">
                                <span class="relative isolate block">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="relative block w-full appearance-none rounded-l-lg pl-10 px-[calc(theme(spacing[3.5])-1px)] py-[calc(theme(spacing[2.5])-1px)] text-base/6 text-zinc-950 placeholder:text-zinc-500 border border-zinc-950/10 bg-transparent dark:bg-white/5 focus:outline-none focus:ring-1 focus:ring-[#52a758]"
                                        placeholder="Search by Name, Email or Mobile...">
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
                        <!-- Add Employee Button -->
                        <div class="ml-0 sm:ml-4 mt-4 sm:mt-0 w-full sm:w-auto">
                            <a href="{{ route('employees.create') }}"
                                class="flex items-center justify-center gap-2 rounded-md bg-[#52a758] px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-[#469d4c] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#52a758] transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Add New Employee
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Code for Delete -->
                <div x-data="{ showModal: false, deleteId: null }">
                    <!-- Table -->
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/12">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/6">
                                        Image
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/4">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/4">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/6">
                                        Mobile
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/6">
                                        Department
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/6">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($employees->isNotEmpty())
                                    @foreach ($employees as $employee)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $employee->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('employees.show', $employee->id) }}" class="block">
                                                    @if($employee->image)
                                                        <img src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->first_name }}" class="h-10 w-10 rounded-full object-cover hover:ring-2 hover:ring-[#52a758] transition-all">
                                                    @else
                                                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-[#52a758] to-[#469d4c] rounded-full flex items-center justify-center text-white font-semibold text-sm shadow-md hover:ring-2 hover:ring-[#52a758] transition-all">
                                                            {{ strtoupper(substr($employee->first_name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                <div class="flex items-center">
                                                    <div class="ml-4">
                                                        <a href="{{ route('employees.show', $employee->id) }}" class="font-medium text-gray-900 hover:text-[#52a758] transition-colors">
                                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $employee->email ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $employee->mobile_country_code }} {{ $employee->mobile_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#134d75] bg-opacity-10 text-[#134d75]">
                                                    {{ $employee->department->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    @can('view employees')
                                                        <a href="{{ route('employees.show', $employee->id) }}"
                                                            class="inline-flex items-center px-3 py-1.5 bg-[#52A758] text-white text-xs font-medium rounded-md hover:bg-[#458F4A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#52A758] transition-colors duration-200">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            </svg>

                                                        </a>
                                                    @endcan
                                                    @can('edit employees')
                                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                                            class="inline-flex items-center px-3 py-1.5 bg-[#134d75] text-white text-xs font-medium rounded-md hover:bg-[#0f3d5e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#134d75] transition-colors duration-200">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>

                                                        </a>
                                                    @endcan
                                                    @can('delete employees')
                                                        <form
                                                            @submit.prevent="showModal = true; deleteId = {{ $employee->id }}"
                                                            class="inline"
                                                            data-loading="false"
                                                            data-modal="true">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>

                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                            No employees found.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Code for Delete -->
                    <x-delete-modal title="Delete Employee"
                        message="Are you sure you want to delete this Employee? This action cannot be undone."
                        :actionUrl="route('employees.destroy', '_ID_')" />
                </div>
                <!-- Code for Delete -->

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

