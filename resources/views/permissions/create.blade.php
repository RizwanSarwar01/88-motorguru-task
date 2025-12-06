<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Home'],
        ['url' => '/settings', 'label' => 'Settings'],
        ['url' => '/permissions', 'label' => 'Permissions'],
        ['url' => '#', 'label' => $title]
    ]" />

    <x-dynamic-heading title="{{$title}}" />

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Main Form Section (col-8) -->
            <div class="lg:col-span-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">

                        <!-- Permission Name Field -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Permission Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                value="{{ old('name') }}"
                                id="name"
                                name="name"
                                type="text"
                                placeholder="Enter permission name (e.g., view users, create posts)"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                            >
                            @error('name')
                                <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <a href="{{ route('permissions.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                                ← Back to Permissions
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-[#52A758] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#458F4A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#52A758] transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Create Permission
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section (col-4) -->
            <div class="lg:col-span-4">
                <!-- Permission Guidelines Card -->
                <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-[#52A758]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Naming Guidelines
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">Follow these conventions for consistent permissions</p>
                        <div class="space-y-3">
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-semibold text-gray-700 mb-1">CRUD Operations:</p>
                                <p class="text-xs text-gray-600">view users, create users, edit users, delete users</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-semibold text-gray-700 mb-1">Special Actions:</p>
                                <p class="text-xs text-gray-600">approve posts, publish articles, manage settings</p>
                            </div>
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-semibold text-gray-700 mb-1">Format:</p>
                                <p class="text-xs text-gray-600">Use lowercase with spaces (e.g., "view reports")</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="bg-gradient-to-br from-[#52A758] to-[#458F4A] shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-white ml-2">Need Help?</h3>
                        </div>
                        <p class="text-sm text-white/90 mb-4">
                            Permissions control what users can do in the system
                        </p>
                        <ul class="space-y-2 text-sm text-white/90">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Permission names must be unique</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Use descriptive, action-based names</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Assign permissions to roles after creation</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
