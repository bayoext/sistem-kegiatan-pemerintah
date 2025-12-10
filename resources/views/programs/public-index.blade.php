<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Program Pemerintah - Sistem Manajemen Kegiatan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased" x-data="{ open: false }">
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
                    <a href="{{ route('programs.public') }}" class="text-gray-700 hover:text-primary-600 font-medium {{ request()->routeIs('programs.public*') ? 'text-primary-600' : '' }}">
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
                <a href="{{ route('programs.public') }}" class="block px-3 py-2 text-gray-700 hover:text-primary-600 hover:bg-gray-50 rounded-md {{ request()->routeIs('programs.public*') ? 'bg-primary-50 text-primary-600' : '' }}">
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

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Program Pemerintah</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Jelajahi berbagai program dan kegiatan pemerintah yang sedang dan akan dilaksanakan
                </p>
            </div>

            <!-- Search & Filter -->
            <div class="bg-gray-50 rounded-lg p-6">
                <form method="GET" action="{{ route('programs.public') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search -->
                        <div class="md:col-span-2">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari program..." 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>

                        <!-- Status Filter -->
                        <div>
                            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <option value="">Semua Status</option>
                                <option value="Perencanaan" {{ request('status') == 'Perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                                <option value="Berjalan" {{ request('status') == 'Berjalan' ? 'selected' : '' }}>Sedang Berjalan</option>
                                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            Menampilkan {{ $programs->count() }} dari {{ $totalPrograms }} program
                        </div>
                        <div class="flex space-x-2">
                            <button type="submit" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors">
                                Cari
                            </button>
                            <a href="{{ route('programs.public') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Programs Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($programs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($programs as $program)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
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
                            {{ $program->status_label }}
                        </span>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ Str::limit($program->description, 120) }}
                    </p>
                    
                    <!-- Categories -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach($program->categories->take(2) as $category)
                        <span class="px-2 py-1 text-xs rounded-full" 
                              style="background-color: {{ $category->color }}20; color: {{ $category->color }}">
                            {{ $category->name }}
                        </span>
                        @endforeach
                        @if($program->categories->count() > 2)
                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">
                            +{{ $program->categories->count() - 2 }} lainnya
                        </span>
                        @endif
                    </div>
                    
                    <!-- Meta Info -->
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $program->start_date->format('d M Y') }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            {{ number_format($program->views) }}
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            oleh {{ $program->user->name }}
                        </div>
                        <a href="{{ route('programs.public.show', $program) }}" 
                           class="text-primary-600 hover:text-primary-800 font-medium text-sm">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $programs->appends(request()->query())->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada program ditemukan</h3>
            <p class="text-gray-500 mb-4">Coba ubah filter pencarian atau kata kunci Anda.</p>
            <a href="{{ route('programs.public') }}" 
               class="inline-flex items-center px-4 py-2 border border-primary-500 text-primary-600 rounded-lg hover:bg-primary-50 transition-colors">
                Lihat Semua Program
            </a>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
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