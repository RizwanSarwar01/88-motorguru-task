<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Home'],
        ['url' => '/settings', 'label' => 'Settings'],
        ['url' => '/users', 'label' => 'Users'],
        ['url' => '#', 'label' => $title]
    ]" />

    <x-dynamic-heading title="{{$title}}" />

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Main Form Section (col-8) -->
            <div class="lg:col-span-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">

                        <!-- Name Field -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                value="{{ old('name', $user->name) }}"
                                id="name"
                                name="name"
                                type="text"
                                placeholder="Enter full name"
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

                        <!-- Username Field -->
                        <div class="mb-6">
                            <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                                Username <span class="text-red-500">*</span>
                            </label>
                            <input
                                value="{{ old('username', $user->username) }}"
                                id="username"
                                name="username"
                                type="text"
                                placeholder="Enter username"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                            >
                            @error('username')
                                <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input
                                value="{{ old('email', $user->email) }}"
                                id="email"
                                name="email"
                                type="email"
                                placeholder="Enter email address"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                            >
                            @error('email')
                                <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Password <span class="text-gray-500 text-xs">(Leave blank to keep current password)</span>
                            </label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="Enter new password"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                            >
                            @error('password')
                                <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                Confirm Password
                            </label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="Confirm your new password"
                                class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                            >
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <a href="{{ route('users.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                                ← Back to Users
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-[#52A758] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#458F4A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#52A758] transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update User
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section (col-4) -->
            <div class="lg:col-span-4">
            <!-- Roles Card -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#52A758]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Assign Roles
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Select one or more roles for this user</p>
                    <div class="space-y-3">
                        @foreach($roles as $role)
                            <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors group">
                                <input
                                    type="checkbox"
                                    name="role[]"
                                    value="{{ $role->id }}"
                                    id="role-{{ $role->id }}"
                                    {{ (is_array(old('role')) && in_array($role->id, old('role'))) ? 'checked' : (old('role') === null && $hasRoles->contains($role->id) ? 'checked' : '') }}
                                    class="h-4 w-4 text-[#52A758] border-gray-300 rounded focus:ring-[#52A758] focus:ring-2"
                                >
                                <span class="ml-3 text-sm font-medium text-gray-700 group-hover:text-gray-900">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('role')
                        <div class="text-red-600 text-sm mt-3 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
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
                        Make sure to fill in all required fields marked with <span class="text-red-200">*</span>
                    </p>
                    <ul class="space-y-2 text-sm text-white/90">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Leave password blank to keep current password</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Username must be unique</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>At least one role must be assigned</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
