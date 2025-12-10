<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sistem Manajemen Kegiatan Pemerintah</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stat-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">Sistem Kegiatan Pemerintah</h1>
                            <p class="text-xs text-gray-500">Pusat Informasi Program & Kegiatan</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 font-medium {{ request()->routeIs('home') ? 'text-primary-600' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('programs.public') }}" class="text-gray-700 hover:text-primary-600 font-medium {{ request()->routeIs('programs.public') ? 'text-primary-600' : '' }}">
                        Program
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-primary-600 font-medium {{ request()->routeIs('about') ? 'text-primary-600' : '' }}">
                        Tentang
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-primary-600 font-medium {{ request()->routeIs('contact') ? 'text-primary-600' : '' }}">
                        Kontak
                    </a>
                    
                    <!-- Auth Links -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-primary-600 font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Register
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-gray-700 hover:text-primary-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" @click.away="open = false" class="md:hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-600' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('programs.public') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md {{ request()->routeIs('programs.public') ? 'bg-primary-50 text-primary-600' : '' }}">
                    Program
                </a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md {{ request()->routeIs('about') ? 'bg-primary-50 text-primary-600' : '' }}">
                    Tentang
                </a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md {{ request()->routeIs('contact') ? 'bg-primary-50 text-primary-600' : '' }}">
                    Kontak
                </a>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-primary-600 hover:text-primary-800 hover:bg-primary-50 rounded-md">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Sistem Manajemen Kegiatan Pemerintah
                </h1>
                <p class="text-xl mb-8 opacity-90 max-w-3xl mx-auto">
                    Platform terpadu untuk mengelola, memantau, dan melaporkan seluruh program dan kegiatan pemerintah secara transparan
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('programs.public') }}" class="bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Jelajahi Program
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="bg-primary-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary-700 transition-colors inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Daftar Sekarang
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="stat-card rounded-xl shadow-lg p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-primary-100 mr-4">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_programs'] }}</p>
                            <p class="text-gray-600">Program Aktif</p>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card rounded-xl shadow-lg p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-green-100 mr-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['Berjalan_programs'] }}</p>
                            <p class="text-gray-600">Sedang Berjalan</p>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card rounded-xl shadow-lg p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-lg bg-purple-100 mr-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_categories'] }}</p>
                            <p class="text-gray-600">Kategori Program</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Programs -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Program Unggulan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Program-program pemerintah yang sedang dan akan dilaksanakan untuk kesejahteraan masyarakat
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latest_programs as $program)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale border border-gray-200">
                    @if($program->thumbnail)
                    <img src="{{ asset('storage/' . $program->thumbnail) }}" 
                         alt="{{ $program->title }}" 
                         class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-r from-primary-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="font-bold text-lg text-gray-900 line-clamp-1">{{ $program->title }}</h3>
                            <span class="px-2 py-1 text-xs rounded-full {{ $program->status_color }}">
                                {{ ucfirst($program->status) }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($program->description, 120) }}
                        </p>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($program->categories->take(2) as $category)
                            <span class="px-2 py-1 text-xs rounded-full" 
                                  style="background-color: {{ $category->color }}20; color: {{ $category->color }}">
                                {{ $category->name }}
                            </span>
                            @endforeach
                        </div>
                        
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $program->created_at->diffForHumans() }}
                            </div>
                            <a href="{{ route('programs.public.show', $program) }}" 
                               class="text-primary-600 hover:text-primary-800 font-medium">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('programs.public') }}" 
                   class="inline-flex items-center px-6 py-3 border border-primary-500 text-primary-600 rounded-lg hover:bg-primary-50 transition-colors font-medium">
                    Lihat Semua Program
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-primary-600 to-purple-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6">Bergabunglah Dengan Kami</h2>
            <p class="text-xl mb-8 opacity-90">
                Dapatkan akses penuh untuk mengelola program dan kegiatan pemerintah dengan lebih efisien dan transparan
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @guest
                <a href="{{ route('register') }}" 
                   class="bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" 
                   class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition-colors">
                    Login
                </a>
                @else
                <a href="{{ route('dashboard') }}" 
                   class="bg-white text-primary-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Ke Dashboard
                </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Sistem Kegiatan Pemerintah</h3>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">
                        Platform terpadu untuk manajemen program dan kegiatan pemerintah yang transparan dan akuntabel.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('programs.public') }}" class="text-gray-400 hover:text-white transition-colors">Program</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kategori</h4>
                    <ul class="space-y-2">
                        @foreach($categories->take(5) as $category)
                        <li>
                            <a href="{{ route('programs.public') }}?category={{ $category->id }}" 
                               class="text-gray-400 hover:text-white transition-colors">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            info@kegiatan-pemerintah.go.id
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            (021) 1234-5678
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Jakarta Pusat, DKI Jakarta
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Sistem Manajemen Kegiatan Pemerintah. Hak cipta dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>
</body>
</html>