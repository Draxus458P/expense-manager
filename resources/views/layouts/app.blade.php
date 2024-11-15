<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-sky-950 shadow-md">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-white">{{ Auth::user()->name }}</h2>
                <nav class="mt-6">
                    <ul>

                        <!-- Conditionally render this menu for Admin users only -->
                        @if (Auth::user()->hasRole('admin'))
                        <li class="mb-4">
                            <a href="#" class="text-white hover:text-blue-300 flex justify-between items-center" onclick="toggleDropdown('userManagementDropdown')">
                                User Management
                                <svg class="w-4 h-4 text-white ml-2 transform transition-transform" id="userManagementArrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill="currentColor" d="M10 13l-4-4h8l-4 4z" />
                                </svg>
                            </a>
                            <ul id="userManagementDropdown" class="hidden ml-4 mt-2">
                                <li class="mb-2">
                                    <a href="{{ route('roles.index') }}" class="text-white hover:text-blue-300">Roles</a>

                                </li>
                                <li>
                                    <a href="{{ route('users.index') }}" class="text-white hover:text-blue-300">Users</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <!-- This menu is visible for all users -->
                        <li class="mb-4">
                            <a href="#" class="text-white hover:text-blue-300 flex justify-between items-center" onclick="toggleDropdown('expenseManagementDropdown')">
                                Expense Management
                                <svg class="w-4 h-4 text-white ml-2 transform transition-transform" id="expenseManagementArrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill="currentColor" d="M10 13l-4-4h8l-4 4z" />
                                </svg>
                            </a>
                            <ul id="expenseManagementDropdown" class="hidden ml-4 mt-2">
                                <li class="mb-2">
                                    <a href="{{ auth()->user()->role == 'admin' ? route('admin.admincategories') : route('user.usercategories') }}" class="text-white hover:text-blue-300">Expense Categories</a>
                                </li>
                                <li>
                                    <a href="{{ auth()->user()->role == 'admin' ? route('admin.adminexpenses') : route('user.userexpenses') }}" class="text-white hover:text-blue-300">Expenses</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endisset

            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const arrow = document.getElementById(dropdownId + 'Arrow');

            // Toggle the dropdown visibility
            dropdown.classList.toggle('hidden');

            // Rotate the arrow
            arrow.classList.toggle('rotate-180');
        }
    </script>
</body>

</html>