<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Dashboard'],
        ['url' => '/employees', 'label' => 'Employees'],
        ['url' => '#', 'label' => 'Employee Details']
    ]" />

    <x-dynamic-heading title="Employee Details" />

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Profile Card -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col items-center">
                        <div class="relative w-36 h-36 mb-4">
                            @if($employee->image)
                                <img src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->first_name }}" class="w-full h-full object-cover rounded-full border-4 border-white shadow-lg ring-2 ring-gray-100">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#52a758] to-[#469d4c] rounded-full flex items-center justify-center text-white font-bold text-4xl shadow-lg">
                                    {{ strtoupper(substr($employee->first_name, 0, 1)) }}{{ $employee->last_name ? strtoupper(substr($employee->last_name, 0, 1)) : '' }}
                                </div>
                            @endif
                            <!-- Status Badge -->
                            <div class="absolute bottom-1 right-1">
                                <span class="flex h-4 w-4">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-4 w-4 bg-green-500 border-2 border-white shadow-sm"></span>
                                </span>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1 text-center">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </h2>
                        @if($employee->designation)
                            <p class="text-sm text-gray-600 mb-2">{{ $employee->designation->name }}</p>
                        @endif
                        <p class="text-xs text-gray-500 font-mono mb-3">#{{ str_pad($employee->id, 6, '0', STR_PAD_LEFT) }}</p>
                        @if($employee->department)
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium bg-[#52A758] bg-opacity-10 text-[#52A758] border border-[#52A758] border-opacity-20">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                {{ $employee->department->name }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-[#52A758] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Contact Information
                    </h3>
                    <div class="space-y-4">
                        @if($employee->email)
                            <div class="flex items-start p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-medium text-gray-500 mb-0.5">Email</p>
                                    <a href="mailto:{{ $employee->email }}" class="text-sm font-medium text-gray-900 hover:text-[#52A758] break-all">{{ $employee->email }}</a>
                                </div>
                            </div>
                        @endif

                        <div class="flex items-start p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-500 mb-0.5">Mobile</p>
                                <a href="tel:{{ $employee->mobile_country_code }}{{ $employee->mobile_number }}" class="text-sm font-medium text-gray-900 hover:text-[#52A758]">{{ $employee->mobile_country_code }} {{ $employee->mobile_number }}</a>
                            </div>
                        </div>

                        @if($employee->alternate_mobile_number)
                            <div class="flex items-start p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-medium text-gray-500 mb-0.5">Alternate Mobile</p>
                                    <a href="tel:{{ $employee->alternate_mobile_country_code }}{{ $employee->alternate_mobile_number }}" class="text-sm font-medium text-gray-900 hover:text-[#52A758]">{{ $employee->alternate_mobile_country_code }} {{ $employee->alternate_mobile_number }}</a>
                                </div>
                            </div>
                        @endif

                        @if($employee->nationality)
                            <div class="flex items-start p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex-shrink-0 w-9 h-9 rounded-lg bg-indigo-50 flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-medium text-gray-500 mb-0.5">Nationality</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $employee->nationality->name }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 text-[#134d75] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                        </svg>
                        Quick Actions
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-[#134d75] text-white text-sm font-medium rounded-lg hover:bg-[#0f3d5e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#134d75] transition-all shadow-sm hover:shadow">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Employee
                        </a>
                        <a href="{{ route('employees.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-white border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Employees
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Content -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="h-8 w-1 bg-gradient-to-b from-[#52A758] to-[#469d4c] rounded-full mr-3"></div>
                        <h2 class="text-xl font-bold text-gray-900">Basic Information</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">First Name</label>
                            <p class="text-base font-medium text-gray-900 p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">{{ $employee->first_name }}</p>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Last Name</label>
                            <p class="text-base font-medium text-gray-900 p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">{{ $employee->last_name ?? 'N/A' }}</p>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Email Address</label>
                            <p class="text-base font-medium text-gray-900 p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors break-all">{{ $employee->email ?? 'N/A' }}</p>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Mobile Number</label>
                            <p class="text-base font-medium text-gray-900 p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">{{ $employee->mobile_country_code }} {{ $employee->mobile_number }}</p>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Alternate Mobile</label>
                            <p class="text-base font-medium text-gray-900 p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">
                                @if($employee->alternate_mobile_number)
                                    {{ $employee->alternate_mobile_country_code }} {{ $employee->alternate_mobile_number }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Nationality</label>
                            <p class="text-base font-medium text-gray-900 p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">{{ $employee->nationality->name ?? 'N/A' }}</p>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Department</label>
                            <p class="text-base font-medium text-gray-900 p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">{{ $employee->department->name ?? 'N/A' }}</p>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Designation</label>
                            <p class="text-base font-medium text-gray-900 p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">{{ $employee->designation->name ?? 'N/A' }}</p>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Date of Birth</label>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-base font-medium text-gray-900">
                                    @if($employee->date_of_birth)
                                        {{ $employee->date_of_birth->format('d M, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Date of Joining</label>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-base font-medium text-gray-900">
                                    @if($employee->date_of_joining)
                                        {{ $employee->date_of_joining->format('d M, Y') }}
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Information -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 rounded-lg bg-[#134d75] bg-opacity-10 flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-[#134d75]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">System Information</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Employee ID</label>
                            <div class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg group-hover:from-blue-100 group-hover:to-indigo-100 transition-colors">
                                <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                </svg>
                                <p class="text-base font-bold text-gray-900">#{{ str_pad($employee->id, 6, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Status</label>
                            <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-200">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Active
                                </span>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Created</label>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <p class="text-base font-medium text-gray-900">{{ $employee->created_at->format('d M, Y h:i A') }}</p>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Last Updated</label>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg group-hover:bg-gray-100 transition-colors">
                                <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <p class="text-base font-medium text-gray-900">{{ $employee->updated_at->format('d M, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
