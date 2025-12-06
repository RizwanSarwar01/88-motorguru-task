<x-app-layout>
    <!-- Header Section -->
    <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-lg mb-6 mt-4 overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        <div class="relative px-8 py-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-slate-300">Here's what's happening with your organization today</p>
                </div>
                <div class="hidden md:block">
                    <div class="text-right text-white">
                        <p class="text-sm text-slate-400 mb-1">{{ now()->format('l, F d, Y') }}</p>
                        <p class="text-xl font-semibold">{{ now()->format('h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
        <!-- Total Employees Card -->
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden hover:border-slate-300 transition-colors duration-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Total Employees</p>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($totalEmployees) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span class="text-emerald-600 font-medium">+{{ $employeesThisMonth }}</span>
                    <span class="text-slate-500 ml-2">this month</span>
                </div>
            </div>
        </div>

        <!-- Employees This Month Card -->
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden hover:border-slate-300 transition-colors duration-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Joined This Month</p>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($employeesThisMonth) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span class="text-blue-600 font-medium">{{ $employeesThisYear }}</span>
                    <span class="text-slate-500 ml-2">this year</span>
                </div>
            </div>
        </div>

        <!-- Total Departments Card -->
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden hover:border-slate-300 transition-colors duration-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Total Departments</p>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($totalDepartments) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span class="text-slate-500">Active departments</span>
                </div>
            </div>
        </div>

        <!-- Total Designations Card -->
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden hover:border-slate-300 transition-colors duration-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-1">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Total Designations</p>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($totalDesignations) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <span class="text-slate-500">Job positions</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
        <!-- Employees by Department -->
        <div class="lg:col-span-2 bg-white rounded-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-slate-900 flex items-center">
                        <svg class="w-5 h-5 text-slate-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Employees by Department
                    </h3>
                    <a href="{{ route('employees.index') }}" class="text-sm text-slate-600 hover:text-slate-900 font-medium transition-colors">
                        View All →
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($employeesByDepartment->count() > 0)
                    <div class="space-y-5">
                        @foreach($employeesByDepartment as $department)
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-slate-900">{{ $department->name }}</span>
                                    <span class="text-sm font-semibold text-slate-700">{{ $department->employees_count }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-slate-900 h-2 rounded-full transition-all duration-500"
                                         style="width: {{ $totalEmployees > 0 ? ($department->employees_count / $totalEmployees * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <p class="text-sm text-slate-500">No departments with employees yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h3 class="text-base font-semibold text-slate-900 flex items-center">
                    <svg class="w-5 h-5 text-slate-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Quick Actions
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-2">
                    <a href="{{ route('employees.create') }}" class="flex items-center p-3 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="font-medium text-sm">Add New Employee</span>
                    </a>
                    <a href="{{ route('employees.index') }}" class="flex items-center p-3 bg-slate-50 text-slate-700 rounded-lg hover:bg-slate-100 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium text-sm">View All Employees</span>
                    </a>
                    <a href="{{ route('users.index') }}" class="flex items-center p-3 bg-slate-50 text-slate-700 rounded-lg hover:bg-slate-100 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="font-medium text-sm">Manage Users</span>
                    </a>
                    <a href="{{ route('settings') }}" class="flex items-center p-3 bg-slate-50 text-slate-700 rounded-lg hover:bg-slate-100 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="font-medium text-sm">Settings</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Employees and Designations -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <!-- Recent Employees -->
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-base font-semibold text-slate-900 flex items-center">
                        <svg class="w-5 h-5 text-slate-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Recent Employees
                    </h3>
                    <a href="{{ route('employees.index') }}" class="text-sm text-slate-600 hover:text-slate-900 font-medium transition-colors">
                        View All →
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentEmployees->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentEmployees as $employee)
                            <div class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @if($employee->image)
                                            <img src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->first_name }}" class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <div class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                {{ strtoupper(substr($employee->first_name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                        <p class="text-xs text-slate-500">
                                            @if($employee->department)
                                                {{ $employee->department->name }}
                                            @endif
                                            @if($employee->designation)
                                                • {{ $employee->designation->name }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-slate-500">{{ $employee->created_at->diffForHumans() }}</p>
                                    <a href="{{ route('employees.show', $employee->id) }}" class="text-xs text-slate-600 hover:text-slate-900 font-medium">
                                        View →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p class="text-sm text-slate-500">No employees yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Employees by Designation -->
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200">
                <h3 class="text-base font-semibold text-slate-900 flex items-center">
                    <svg class="w-5 h-5 text-slate-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Top Designations
                </h3>
            </div>
            <div class="p-6">
                @if($employeesByDesignation->count() > 0)
                    <div class="space-y-3">
                        @foreach($employeesByDesignation as $designation)
                            <div class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">{{ $designation->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $designation->employees_count }} employee{{ $designation->employees_count != 1 ? 's' : '' }}</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded-full">
                                    {{ $designation->employees_count }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-slate-500">No designations with employees yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
