<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Program Management') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ mobileOpen: false }">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex items-center space-x-3">
                            <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="flex items-center space-x-3">
                                
                                <div>
                                    <span class="text-lg font-bold text-gray-900">Sistem Kegiatan Pemerintah</span>
                                    <div class="text-xs text-gray-500 font-medium">Dashboard</div>
                                </div>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden md:flex items-center space-x-1 ml-8">
                            @auth
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                                </svg>
                                Dashboard
                            </a>
                            <a href="{{ route('programs.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('programs.*') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                Program
                            </a>
                            <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Kategori
                            </a>
                            @if(auth()->user()->isSuperAdmin())
                            <a href="{{ route('users.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                </svg>
                                Users
                            </a>
                            @endif
                            @else
                            <!-- Guest Navigation -->
                            <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Beranda
                            </a>
                            <a href="{{ route('programs.public') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('programs.public*') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Program
                            </a>
                            <a href="{{ route('about') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('about') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Tentang
                            </a>
                            <a href="{{ route('contact') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Kontak
                            </a>
                            @endauth
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="hidden md:flex items-center space-x-4">
                        @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-3 px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-all duration-200">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold text-sm">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="text-left">
                                    <div class="font-medium">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ Auth::user()->role_display }}</div>
                                </div>
                                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Profile
                                </a>
                                <hr class="my-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <!-- Guest Links -->
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                                Register
                            </a>
                        </div>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button @click="mobileOpen = !mobileOpen" class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div x-show="mobileOpen" @click.away="mobileOpen = false" x-transition class="md:hidden bg-white border-t border-gray-200">
                @auth
                <div class="px-4 py-4 space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        </svg>
                        Dashboard
                    </a>
                    <a href="{{ route('programs.index') }}" class="flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('programs.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        Program
                    </a>
                    <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Kategori
                    </a>
                    @if(auth()->user()->isSuperAdmin())
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        Users
                    </a>
                    @endif
                </div>

                <!-- User Info & Logout -->
                <div class="px-4 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
                @else
                <!-- Guest Responsive Menu -->
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('home')">
                        {{ __('Beranda') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('programs.public')">
                        {{ __('Program') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('about')">
                        {{ __('Tentang') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('contact')">
                        {{ __('Kontak') }}
                    </x-responsive-nav-link>
                </div>
                
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('login')">
                            {{ __('Login') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
                @endauth
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6 lg:py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-green-700">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-red-700">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
