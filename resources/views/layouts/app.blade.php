<!DOCTYPE html>
<html class="h-full antialiased" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'JEH Journal') }} - Admin Dashboard</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-gradient-to-br from-slate-50 via-white to-slate-100" x-data="{ sidebarOpen: false, profileMenuOpen: false }">
    <!-- Universal Loading Spinner -->
    <x-loading-spinner message="Loading..." />

    <!-- Toast Notification Container -->
    <x-toast-container position="top-right" />

    <div class="min-h-full">
        @include('layouts.sidebar')

        <div class="lg:pl-72">
            @include('layouts.header')

            <main>
                <div class="p-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
