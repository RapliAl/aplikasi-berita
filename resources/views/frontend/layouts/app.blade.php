<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'News Portal') }} - @yield('title', 'Latest News')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('articles.index') }}" class="text-2xl font-bold text-gray-900">
                            {{ config('app.name', 'News Portal') }}
                        </a>
                    </div>
                    
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 border-b-2 {{ request()->routeIs('dashboard') ? 'border-indigo-500' : 'border-transparent hover:border-gray-300' }}">
                            Dashboard
                        </a>
                        
                        <a href="{{ route('articles.index') }}" 
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900 border-b-2 {{ request()->routeIs('articles.index') ? 'border-indigo-500' : 'border-transparent hover:border-gray-300' }}">
                            Home
                        </a>
                    </div>
                </div>

                <!-- Right side navigation -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- User is logged in -->
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-700">Welcome, {{ Auth::user()->name }}</span>
                                
                                @if(Auth::user()->hasRole(['Admin', 'Author']))
                                    <a href="/admin" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">
                                        Admin Panel
                                    </a>
                                @endif
                                
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- User is not logged in -->
                        <div class="space-x-4">
                            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-md hover:bg-indigo-700">
                                Register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('articles.index') }}" 
                   class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('articles.index') ? 'text-indigo-700 bg-indigo-50 border-r-4 border-indigo-500' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-50' }}">
                    Home
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 mt-20">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-400 text-sm">
                    © {{ date('Y') }} {{ config('app.name', 'News Portal') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Toggle mobile menu
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }
    </script>
</body>
</html>
